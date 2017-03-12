<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Session;
use DB;
use Hash;
use Auth;
use Image;
use File;

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

    public function showDashboard()
    {
        return view('admins.dashboard');
    }

    public function showGuests()
    {
        $guests = User::orderBy('firstname')->where('company','not like','ncspectrum')->get();
        return view('admins.guests')->withGuests($guests);
    }

     public function showEmployees()
    {
        $employees = User::orderBy('firstname')->where('company','like','ncspectrum')->get();
        return view('admins.employees')->withEmployees($employees);
    }

     public function showAdmins()
    {
        $admins = Admin::orderBy('firstname')->where('id', '!=', 1)->get();
        return view('admins.admins')->withAdmins($admins);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDeleteUser($id)
    {
        $users = User::find($id);
        return view('admins.showDeleteUser')->withUser($users);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDeleteAdmin($id)
    {
        $admin = Admin::find($id);
        return view('admins.showDeleteAdmin')->withAdmin($admin);
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
        if(Auth::user()->id == 1)
        {
            return redirect()->route('admins.admins');
        }
        else
        {
            return redirect()->route('admins.showProfile');
        }
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
        $sysadmin = Admin::find(1);

        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('password');

        if(Auth::user()->id == 1)
        {
            $databasePassword = $sysadmin->password;
        }
        else
        {
            $databasePassword = $admin->password;
        }

        if(Hash::check($currentPassword, $databasePassword))
        {
            if(Hash::check($newPassword, $databasePassword))
            {
                Session::flash('error', 'The new password can not be equal to the System Administrator password.');
                return redirect()->back();
            }
            else
            {
                $password = bcrypt($newPassword);
                $admin->password = $password;
                $admin->save();

                Session::flash('success', 'The password has been successfully updated!');
                if(Auth::user()->id == 1)
                {
                    return redirect()->route('admins.admins');
                }
                else
                {
                    return redirect()->route('admins.showProfile');
                }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin(Request $request, $id)
    {
        $this->validate($request, [
                'password' => 'required|min:6|max:60|regex:/^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$/|',
            ]);

        $admin = Admin::find($id);
        $sysadmin = Admin::find(1);

        $databasePassword = $sysadmin->password;
        $password = $request->input('password');

        if(Hash::check($password, $databasePassword))
        {
            $admin->delete();

            Session::flash('success', 'The Admin has been successfully deleted!');
            return redirect()->route('admins.admins');
        }
        else
        {
            Session::flash('error', 'The password is not correct.');
            return redirect()->back();
        }
    }

    public function showLog()
    {
        $users = User::get();

        return view ('admins.log')->withUsers($users);
    }

    public function showUserlog($id)
    {
        $users = User::find($id);

        return view ('admins.userlog')->withUsers($users);
    }

    public function showProfile()
    {
        $admin = Auth::user();
        return view('admins.profile')->withAdmin($admin);
    }

    public function updateAvatar(Request $request)
    {
            if($request->hasFile('avatar'))
            {
                $admin = Admin::find(Auth::user()->id);
                $avatar = $request->file('avatar');
                $filename = time().'.'.$avatar->getClientOriginalExtension();

                if($admin->avatar !== 'default.jpg')
                {
                    $file = public_path('uploads/avatars/'.$admin->avatar);
                    if(File::exists($file))
                    {
                        unlink($file);
                    }
                }

                Image::make($avatar)->fit(300, 300)->save(public_path('uploads/avatars/'.$filename));

                $admin = Auth::user();
                $admin->avatar = $filename;
                $admin->save();
                return view('admins.profile')->withAdmin($admin);
            }
            else
            {
                Session::flash('error', 'You must upload a picture!');
                return redirect()->back();
            }
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

            // If the search is for admins
            if($type === 'admins')
            {
                if($search != "")
                {
                    $admins = DB::table('admins')
                        ->where('id', '!=', 1)
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->get();
                }
                else
                {
                    $admins = Admin::orderBy('firstname')->where('id', '!=', 1)->get();
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
            /** 
            * If the search is for either a guest or employee.
            * In this case we use the word 'user' for both guests and employees. 
            * We seperate between these two by looking at the company names. 
            */
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
