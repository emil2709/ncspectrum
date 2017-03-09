<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use Session;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 		$users = User::orderBy('id','desc')->where('company','not like','ncspectrum')->paginate(5);
        return view('users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);

        $user = new User();
    	$user->firstname = ucwords(strtolower($request->firstname));
    	$user->lastname = ucwords(strtolower($request->lastname));
    	$user->phone = $request->phone;
    	$user->email = strtolower($request->email);
    	$user->company = strtolower($request->company);
        $user->save();

        $visit = new \App\Visit();
        //$visit->date = '2017';
        //$visit->from = '20:20';
        //$visit->to = '21:20';
        //$visit->company = strtolower($request->company);
        //$visit->comment = 'Det kommer damer';

        $user->visits()->save($visit);

        $status = new \App\Status();

        $status->status = false;

        $user->statuses()->save($status);
    

        Session::flash('success', 'The User was successfully created!');

    	return redirect()->route('users.index');
    }

    /**
    * Function for livesearching the specified resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function usersearch(Request $request)
    {        
        if($request->ajax())
        {
            $search = $request->usersearch;
            $output = "";

            if($search != "")
            {
                $users = DB::table('users')
                    ->where('company', 'not like', 'ncspectrum')
                    ->where('firstname', 'like', '%'.$search.'%')
                    ->orWhere('lastname', 'like', '%'.$search.'%')
                    ->where('company', 'not like', 'ncspectrum')
                    ->orWhere('company', 'like', '%'.$search.'%')
                    ->paginate(5);
            }
            else
            {
                $users = User::orderBy('id', 'desc')->where('company','not like','ncspectrum')->paginate(5);
            }

            foreach($users as $user)
            {
                $output.=
                    '<li id="outlist-box" class="userbox">'.
                        '<div class="row">'.
                            '<div class="col-md-12">'.
                                '<div class="text-center lead">'.
                                    '<strong>'.
                                        $user->firstname.
                                        ' '.
                                        $user->lastname.
                                    '</strong>'.
                                '</div>'.
                                '<div class="col-md-12 text-center">'.
                                    $user->email.'<br/>'.
                                    $user->company.
                                '</div>'.
                            '</div>'.
                        '</div>'.
                    '</li>';
            }

            if($output == "")
            {
                $output = "<div class='margin-top text-center' id='notfound'><strong>".$search."</strong> was not found</div>";
                return Response($output);
            }
            else
            {
                return Response($output);
            }   
        }

    }

    public function wip()
    {
        return view('users.wip');
    }

}
