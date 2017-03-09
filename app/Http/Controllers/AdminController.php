<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Session;
use DB;
use Hash;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $admin = Admin::find($id);
        return view('admins.editAdmin')->withAdmin($admin);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAdminPassword($id)
    {
        $admin = Admin::find($id);
        return view('admins.editAdminPassword')->withAdmin($admin);
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

        $user->firstname = ucwords(strtolower($request->input('firstname')));
        $user->lastname = ucwords(strtolower($request->input('lastname')));
        $user->phone = $request->input('phone');
        $user->email= strtolower($request->input('email'));
        $user->company = ucwords(strtolower($request->input('company')));
        $user->save();

        if($user->company != 'Ncspectrum')
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
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'email' => 'required|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
            ]);

        $admin = Admin::find($id);

        $admin->firstname = ucwords(strtolower($request->input('firstname')));
        $admin->lastname = ucwords(strtolower($request->input('lastname')));
        $admin->email= strtolower($request->input('email'));
        $admin->save();

        Session::flash('success', "Changes has been made to the Admin.");
        return redirect()->route('admins.dashboard');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdminPassword(Request $request, $id)
    {
        $this->validate($request, [
                'currentPassword' => 'required|min:6|max:60|regex:/^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$/',
                'password' => 'required|min:6|max:60|regex:/^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$/|confirmed',
                'password_confirmation' => 'required|min:6|max:60|regex:/^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$/',
            ]);

        $admin = Admin::find($id);
        $databasePassword = $admin->password;
        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('password');

        if(Hash::check($currentPassword, $databasePassword))
        {
            if(Hash::check($newPassword, $databasePassword))
            {
                Session::flash('error', 'The new password can not be equal to the current password.');
                return redirect()->back();
            }
            else
            {
                $password = bcrypt($newPassword);
                $admin->password = $password;
                $admin->save();

                Session::flash('success', 'The password has been successfully updated!');
                return redirect()->route('admins.admins');
            }
        }
        else
        {
            Session::flash('error', 'The current password is not correct.');
            return redirect()->back();
        }
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

        if($company != 'Ncspectrum')
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

    public function userlog($id)
    {
        $users = User::find($id);

        return view ('admins.userlog')->withUsers($users);
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
                                '<a href="admin_'.$admin->id.'/edit" title="Edit">'.
                                '<span class="glyphicon glyphicon-edit"></span></a>'.
                            '</td>'.
                            '<td>'.
                                '<a href="admin_'.$admin->id.'/edit" title="Edit Password">'.
                                '<span class="glyphicon glyphicon-lock"></span></a>'.
                            '</td>'.
                            '<td>'.
                                '<a href="#" title="Delete">'.
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
                            ->where('company', 'not like', 'ncspectrum')
                            ->orWhere('company', 'like', '%'.$search.'%')
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
                                    '<a href="/admin/user_'.$user->id.'/edit" title="Edit">'.
                                    '<span class="glyphicon glyphicon-edit"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admin/'.$user->id.'/userlog" title="Log">'.
                                    '<span class="glyphicon glyphicon-th-list"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admin/user_'.$user->id.'/delete" title="Delete">'.
                                    '<span class="glyphicon glyphicon-trash"></span></a>'.
                                '</td>'.
                            '</tr>';
                }
            }

            if($output == "")
            {
                $output = "<div class='margin-top' id='notfound'><strong>".$search."</strong> was not found</div>";
                return Response($output);
            }
            else
            {
                return Response($output);
            }   
        }

    }
}
