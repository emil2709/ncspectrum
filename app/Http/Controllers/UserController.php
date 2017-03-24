<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
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
        $usersout = DB::table('users')
            ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
            ->where('status', false)
            ->where('company','not like','NC-Spectrum')
            ->orderBy('id','desc')
            ->paginate(5);
        
        $usersin = DB::table('users')
            ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
            ->where('status', true)
            ->where('company','not like','NC-Spectrum')
            ->orderBy('id','desc')
            ->get();

        return view('users.index', compact('usersout', 'usersin'));
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
    public function storeUser(Request $request)
    {
    	$this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|unique:users|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);

        $user = new User();
    	$user->firstname = ucwords(strtolower($request->firstname));
    	$user->lastname = ucwords(strtolower($request->lastname));
    	$user->phone = $request->phone;
    	$user->email = strtolower($request->email);
    	$user->company = ucwords(strtolower($request->company));
        $user->save();

        $status = new \App\Status();
        $status->status = false;
        $user->statuses()->save($status);
    
        Session::flash('success', 'The User was successfully created!');

    	return redirect()->route('users.index');
    }

    public function userlist(Request $request)
    {
        $users = $request->data;
        session()->put('userlist', $users);

        return response()->json();
    }

    public function visit(Request $request)
    {
        $userlist = session()->get('userlist');
        $users = array();

        for($i=0;$i<count($userlist);$i++)
        {
            $user = User::find($userlist[$i]);
            array_push($users, $user);
        }

        $employees = User::orderBy('firstname')->where('company','NC-Spectrum')->get();

        return view('users.visit', compact('users', 'employees'));      
    }

    public function storeVisit(Request $request)
    {
        $users = $request->users;
        $employees = $request->employees;

        Log::info($users);
        Log::info($employees);

        // Create visit with users and employee here

        return redirect()->route('users.index');

    }

    public function statusin(Request $request)
    {
        $userid = $request->data;

        $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => true]);

        return response()->json();
    }

    public function statusout(Request $request)
    {
        $userid = $request->data;

        $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => false]);

        return response()->json();
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
                    ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')

                    ->where('status', false)
                    ->where('firstname', 'like', '%'.$search.'%')
                    ->orWhere('lastname', 'like', '%'.$search.'%')
                    ->where('company','not like','NC-Spectrum')
                    ->where('status', false)
                    ->orWhere('company', 'like', '%'.$search.'%')
                    ->where('company','not like','NC-Spectrum')
                    ->orderBy('id','desc')
                    ->paginate(5);
            }
            else
            {
                $users = DB::table('users')
                    ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                    ->where('status', false)
                    ->where('company','not like','NC-Spectrum')
                    ->orderBy('id','desc')
                    ->paginate(5);
            }

            foreach($users as $user)
            {
                $output.=
                    '<li id="outlist-box" class="userbox">'.
                    '<div id="userid">'.$user->id.'</div>'.
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
