<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Admin;
use App\User;
use App\Log;
use App\Status;
use App\Visit;
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
        $guests = User::orderBy('firstname')->where('company','<>','NC-Spectrum')->paginate(20);
        return view('admins.guests')->withGuests($guests);
    }

     public function showEmployees()
    {
        $employees = User::orderBy('firstname')->where('company','NC-Spectrum')->paginate(20);
        return view('admins.employees')->withEmployees($employees);
    }

     public function showAdmins()
    {
        $admins = Admin::orderBy('firstname')->where('id', '!=', 1)->paginate(20);
        return view('admins.admins')->withAdmins($admins);
    }

    public function showVisits()
    {
        $visits = Visit::get();

        $guests = array();
        $visitguests = array();
        foreach($visits as $visit)
        {   
            $guestrows = DB::table('user_visit')
                ->where('visit_id', $visit->id)
                ->get();

            foreach($guestrows as $row)
            {
                $guest = DB::table('users')
                ->where('id', $row->user_id)
                ->get();

                array_push($guests, $guest);
            }
            $visitguests[$visit->id][] = $guests;
            $guests = array();
        }

        return view('admins.visits', compact('visits', 'visitguests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDeleteGuest($id)
    {
        $guests = User::find($id);

        return view('admins.deleteGuest')->withGuest($guests);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDeleteEmployee($id)
    {
        $employees = User::find($id);

        return view('admins.deleteEmployee')->withEmployee($employees);
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
        return view('admins.deleteAdmin')->withAdmin($admin);
    }


    public function showCreateGuest()
    {
        return view('admins.createGuest');
    }

    public function showCreateEmployee()
    {
        return view('admins.createEmployee');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditGuest($id)
    {
        $guest = User::find($id);
        return view('admins.editGuest')->withGuest($guest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditEmployee($id)
    {
        $employee = User::find($id);
        return view('admins.editEmployee')->withEmployee($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditAdmin($id)
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
    public function showEditAdminPassword($id)
    {
        $admin = Admin::find($id);
        return view('admins.editAdminPassword')->withAdmin($admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGuest(Request $request)
    {
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|unique:users|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);

        $company = strtolower($request->company);
        if (in_array($company, array('nc spectrum', 'nc-spectrum', 'nc.spectrum', 'ncspectrum')))
        {
            Session::flash('error', 'The company name is invalid.');
            return redirect()->back()->withInput(Input::all());
        }

        $guest = new User();
        $guest->firstname = ucwords(strtolower($request->firstname));
        $guest->lastname = ucwords(strtolower($request->lastname));
        $guest->phone = $request->phone;
        $guest->email = strtolower($request->email);
        $guest->company = ucwords(strtolower($request->company));
        $guest->save();
        /*
        $visit = new \App\Visit();
        //$visit->date = '2017';
        //$visit->from = '20:20';
        //$visit->to = '21:20';
        //$visit->company = strtolower($request->company);
        //$visit->comment = 'Det kommer damer';

        $guest->visits()->save($visit);
        */
        $status = new \App\Status();

        $status->status = false;

        $guest->statuses()->save($status);

        $this->userlog('guest', 'create', $guest->firstname.' '.$guest->lastname);
    
        Session::flash('success', 'The Guest was successfully created!');

        return redirect()->route('admins.guests');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmployee(Request $request)
    {
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|unique:users|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/'
            ]);

        $employee = new User();
        $employee->firstname = ucwords(strtolower($request->firstname));
        $employee->lastname = ucwords(strtolower($request->lastname));
        $employee->phone = $request->phone;
        $employee->email = strtolower($request->email);
        $employee->company = "NC-Spectrum";
        $employee->save();

        $this->userlog('employee', 'create', $employee->firstname.' '.$employee->lastname);    

        Session::flash('success', 'The Employee was successfully created!');

        return redirect()->route('admins.employees');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGuest(Request $request, $id)
    {
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|unique:users,phone,'.$id.'|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users,email,'.$id.
                    '|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);

        $company = strtolower($request->company);
        if (in_array($company, array('nc spectrum', 'nc-spectrum', 'nc.spectrum', 'ncspectrum')))
        {
            Session::flash('error', 'The company name is invalid.');
            return redirect()->back()->withInput(Input::all());
        }

        $guest = User::find($id);
        $guest->firstname = ucwords(strtolower($request->input('firstname')));
        $guest->lastname = ucwords(strtolower($request->input('lastname')));
        $guest->phone = $request->input('phone');
        $guest->email= strtolower($request->input('email'));
        $guest->company = ucwords(strtolower($request->input('company')));
        $guest->save();

        $this->userlog('guest', 'update', $guest->firstname.' '.$guest->lastname);

        Session::flash('success', "Changes has been made to the Guest.");
        return redirect()->route('admins.guests');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmployee(Request $request, $id)
    {
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|unique:users,phone,'.$id.'|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users,email,'.$id.
                    '|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/'
            ]);

        $employee = User::find($id);

        $employee->firstname = ucwords(strtolower($request->input('firstname')));
        $employee->lastname = ucwords(strtolower($request->input('lastname')));
        $employee->phone = $request->input('phone');
        $employee->email= strtolower($request->input('email'));
        $employee->company = 'NC-Spectrum';
        $employee->save();

        $this->userlog('employee', 'update', $employee->firstname.' '.$employee->lastname);

        Session::flash('success', "Changes has been made to the Employee.");
        return redirect()->route('admins.employees');
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
                'email' => 'required|unique:admins,email,'.$id.
                    '|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/'
            ]);

        $admin = Admin::find($id);

        $admin->firstname = ucwords(strtolower($request->input('firstname')));
        $admin->lastname = ucwords(strtolower($request->input('lastname')));
        $admin->email= strtolower($request->input('email'));
        $admin->save();

        $this->adminlog('update', $admin->firstname.' '.$admin->lastname);

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
                if(Auth::user()->id == 1)
                {
                    Session::flash('error', 'The new password can not be equal to the System Administrator password.');
                }
                else
                {
                    Session::flash('error', 'The new password can not be equal to your current password.');
                }
                return redirect()->back();
            }
            else
            {
                $password = bcrypt($newPassword);
                $admin->password = $password;
                $admin->save();

                $this->adminlog('password', $admin->firstname.' '.$admin->lastname);

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
    public function destroyGuest($id)
    {
        $guest = User::find($id);
        $guest->visits()->detach();
        $guest->statuses()->delete();
        $guest->delete();

        $this->userlog('guest', 'delete', $guest->firstname.' '.$guest->lastname);

        Session::flash('success', 'The Guest was successfully deleted!');
        return redirect()->route('admins.guests');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEmployee($id)
    {
        $employee = User::find($id);
        $employee->visits()->detach();
        $employee->delete();

        $this->userlog('employee', 'delete', $employee->firstname.' '.$employee->lastname);

        Session::flash('success', 'The Employee was successfully deleted!');
        return redirect()->route('admins.employees');
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

            $this->adminlog('delete', $admin->firstname.' '.$admin->lastname);

            Session::flash('success', 'The Admin has been successfully deleted!');
            return redirect()->route('admins.admins');
        }
        else
        {
            Session::flash('error', 'The password is not correct.');
            return redirect()->back();
        }
    }

    public function showGuestVisits($id)
    {
        $user = User::find($id);

        return view ('admins.guestvisits')->withUser($user);
    }

    public function showEmployeeVisits($id)
    {
        $employee = User::find($id);

        $visits = DB::table('visits')
                    ->where('employee_firstname','=', $employee->firstname)
                    ->where('employee_lastname','=', $employee->lastname)
                    ->get();

        $guests = array();
        $visitguests = array();
        foreach($visits as $visit)
        {   
            $guestrows = DB::table('user_visit')
                ->where('visit_id', $visit->id)
                ->get();

            foreach($guestrows as $row)
            {
                $guest = DB::table('users')
                ->where('id', $row->user_id)
                ->get();

                array_push($guests, $guest);
            }
            $visitguests[$visit->id][] = $guests;
            $guests = array();
        }

        return view ('admins.employeevisits', compact('employee', 'visits', 'visitguests'));
    }

    public function showStatus()
    {
        $users = User::with('status')->get();
        
        return view ('admins.status')->withUsers($users);
    }

    public function checkOut($id)
    {
        $users = User::find($id);
        $users->status()->update(['status' => 0]);

        return redirect('admin/status');
    }

    public function showLog()
    {
        $log = Log::orderBy('id', 'desc')->paginate(20);
        return view('admins.log')->withLog($log);
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

                $this->adminlog('avatar', $admin->firstname.' '.$admin->lastname);                

                return view('admins.profile')->withAdmin($admin);
            }
            else
            {
                Session::flash('error', 'You must upload a picture!');
                return redirect()->back();
            }
    }


    public function userlog($role, $type, $user)
    {
        $log = new Log();

        $admin = trim(Auth::user()->firstname.' '.Auth::user()->lastname);

        switch ($type) 
        {
            case 'create':
                $status = 'created';
                break;
            case 'update':
                $status = 'updated';
                break;
            case 'delete':
                $status = 'deleted';
                break;
        }

        $role = ucfirst(strtolower($role));

        $data = 'Admin: '.$admin.', '.$status.' '.$role.': '.$user.'.';

        $log->type = $type;
        $log->information = $data;
        $log->created_at = Carbon::now();
        $log->save();
    }

    public function adminlog($type, $user)
    {
        $log = new Log();

        $admin = trim(Auth::user()->firstname.' '.Auth::user()->lastname);
        $user = trim($user);

        switch ($type) 
        {
            case 'create':
                $data = 'Admin: '.$admin.', created Admin: '.$user.'.';
                break;
            case 'update':
                $data = 'Admin: '.$admin.', updated Admin: '.$user.'.';
                break;
            case 'delete':
                $data = 'Admin: '.$admin.', deleted Admin: '.$user.'.';
                break;
            case 'avatar':
                $data = 'Admin: '.$admin.', changed Admin: '.$user.'\'s avatar.';
                break;
            case 'password':
                $data = 'Admin: '.$admin.', updated Admin: '.$user.'\'s password.';
                break;
        }

        $log->type = $type;
        $log->information = $data;
        $log->created_at = Carbon::now();
        $log->save();
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
                                '<a href="admin/'.$admin->id.'/edit" title="Edit">'.
                                '<span class="glyphicon glyphicon-edit"></span></a>'.
                            '</td>'.
                            '<td>'.
                                '<a href="admin/'.$admin->id.'/edit" title="Edit Password">'.
                                '<span class="glyphicon glyphicon-lock"></span></a>'.
                            '</td>'.
                            '<td>'.
                                '<a href="admin/'.$admin->id.'/delete" title="Delete">'.
                                '<span class="glyphicon glyphicon-trash"></span></a>'.
                            '</td>'.
                        '</tr>';
                }
            }

            elseif($type === 'guests')
            {
                if($search != "")
                {
                    $guests = DB::table('users')
                        ->where('company', 'not like', 'NC-Spectrum')
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->orWhere('company', 'like', '%'.$search.'%')
                        ->where('company', 'not like', 'NC-Spectrum')
                        ->get();
                }
                else
                {
                    $guests = User::orderBy('firstname')->where('company','not like','NC-Spectrum')->get();
                }

                foreach($guests as $guest)
                {
                    $output.=
                            '<tr>'.
                                '<td>'.$guest->firstname.'</td>'.
                                '<td>'.$guest->lastname.'</td>'.
                                '<td>'.$guest->phone.'</td>'.
                                '<td>'.$guest->email.'</td>'.
                                '<td>'.$guest->company.'</td>'.
                                '<td>'.
                                    '<a href="/admin/guest/'.$guest->id.'/edit" title="Edit">'.
                                    '<span class="glyphicon glyphicon-edit"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admin/guest/'.$guest->id.'/visits" title="Guest Visits">'.
                                    '<span class="glyphicon glyphicon-th-list"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admin/guest/'.$guest->id.'/delete" title="Delete">'.
                                    '<span class="glyphicon glyphicon-trash"></span></a>'.
                                '</td>'.
                            '</tr>';
                }
            }

            else
            {
                if($search != "")
                {
                    $employees = DB::table('users')
                        ->where('company', 'like', 'NC-Spectrum')
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->where('company', 'like', 'NC-Spectrum')
                        ->get();
                }
                else
                {
                    $employees = User::orderBy('firstname')->where('company','like','NC-Spectrum')->get();
                }

                foreach($employees as $employee)
                {
                    $output.=
                            '<tr>'.
                                '<td>'.$employee->firstname.'</td>'.
                                '<td>'.$employee->lastname.'</td>'.
                                '<td>'.$employee->phone.'</td>'.
                                '<td>'.$employee->email.'</td>'.
                                '<td>'.$employee->company.'</td>'.
                                '<td>'.
                                    '<a href="/admin/employee/'.$employee->id.'/edit" title="Edit">'.
                                    '<span class="glyphicon glyphicon-edit"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admin/employee/'.$employee->id.'/visits" title="Employee Visits">'.
                                    '<span class="glyphicon glyphicon-th-list"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admin/employee/'.$employee->id.'/delete" title="Delete">'.
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
