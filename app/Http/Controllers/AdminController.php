<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Session;
use DB;

class AdminController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
	*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 		return view('auth.login');
    }

    public function dashboard()
    {
        return view('admins.dashboard');
    }

    public function guests()
    {
        $guests = User::orderBy('firstname')->where('company','not like','ncspectrum')->get();
        return view('admins.guests')->withGuests($guests);
    }

     public function employees()
    {
        $employees = User::orderBy('firstname')->where('company','like','ncspectrum')->get();
        return view('admins.employees')->withEmployees($employees);
    }

     public function admins()
    {
        $admins = Admin::orderBy('firstname')->get();
        return view('admins.admins')->withAdmins($admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $users = User::find($id);
        return view('admins.showUser')->withUser($users);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdmin($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admins.editUser')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAdmin($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);

        $user = User::find($id);

        $user->firstname = strtolower($request->input('firstname'));
        $user->lastname = strtolower($request->input('lastname'));
        $user->phone = strtolower($request->input('phone'));
        $user->email= strtolower($request->input('email'));
        $user->company = strtolower($request->input('company'));
        $user->save();

        if($user->company != 'ncspectrum')
        {
            Session::flash('success', "Changes has been made to the Guest.");
            return redirect()->route('admins.guests');
        }
        else
        {
            Session::flash('success', "Changes has been made to the Employee.");
            return redirect()->route('admins.employees');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        $user = User::find($id);
        $company = $user->company;
        $user->delete();

        if($company != 'ncspectrum')
        {
            Session::flash('success', 'The Guest was successfully deleted!');
            return redirect()->route('admins.guests');
        }
        else
        {
            Session::flash('success', 'The Employee was successfully deleted!');
            return redirect()->route('admins.employees');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin($id)
    {
        //
    }
    public function log()
    {
        $users = User::get();

        return view ('admins.log')->withUsers($users);
    }

    public function logUser($id)
    {
        $users = User::find($id);

        return view ('admins.logUser')->withUsers($users);
    }


    /**
    * Function for livesearching the specified resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function search(Request $request)
    {        
        if($request->ajax())
        {
            $search = $request->search;
            $type = $request->type;
            $output = "";

            if($type === 'admins')
            {
                if($search != "")
                {
                    $admins = DB::table('admins')
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->get();
                }
                else
                {
                    $admins = Admin::orderBy('firstname')->get();
                }

                foreach($admins as $admin)
                {
                    $output.=
                        '<tr>'.
                            '<td>'.$admin->firstname.'</td>'.
                            '<td>'.$admin->lastname.'</td>'.
                            '<td>'.$admin->email.'</td>'.
                            '<td>'.
                                '<a href="#">'.
                                '<span class="glyphicon glyphicon-edit"></span></a>'.
                            '</td>'.
                            '<td>'.
                                '<a href="#">'.
                                '<span class="glyphicon glyphicon-trash"></span></a>'.
                            '</td>'.
                        '</tr>';
                }
            }
            else
            {
                if($type === 'guests')
                {
                    if($search != "")
                    {
                        $users = DB::table('users')
                            ->where('company', 'not like', 'ncspectrum')
                            ->where('firstname', 'like', '%'.$search.'%')
                            ->orWhere('lastname', 'like', '%'.$search.'%')
                            ->orWhere('company', 'like', '%'.$search.'%')
                            ->where('company', 'not like', 'ncspectrum')
                            ->get();
                    }
                    else
                    {
                        $users = User::orderBy('firstname')->where('company','not like','ncspectrum')->get();
                    }

                }
                else
                {
                    if($search != "")
                    {
                        $users = DB::table('users')
                            ->where('company', 'like', 'ncspectrum')
                            ->where('firstname', 'like', '%'.$search.'%')
                            ->orWhere('lastname', 'like', '%'.$search.'%')
                            ->where('company', 'like', 'ncspectrum')
                            ->get();
                    }
                    else
                    {
                        $users = User::orderBy('firstname')->where('company','like','ncspectrum')->get();
                    }
                }

                foreach($users as $user)
                {
                    $output.=
                            '<tr>'.
                                '<td>'.$user->firstname.'</td>'.
                                '<td>'.$user->lastname.'</td>'.
                                '<td>'.$user->phone.'</td>'.
                                '<td>'.$user->email.'</td>'.
                                '<td>'.$user->company.'</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'/edit">'.
                                    '<span class="glyphicon glyphicon-edit"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'">'.
                                    '<span class="glyphicon glyphicon-trash"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'/loguser">'.
                                    '<span class="glyphicon glyphicon-th-list"></span></a>'.
                                '</td>'.
                            '</tr>';
                }
            }

            if($output == "")
            {
                $output = "<div class='margin-top' id='notfound'><strong>".$search."</strong> Not Found</div>";
                return Response($output);
            }
            else
            {
                return Response($output);
            }   
        }

    }
}
