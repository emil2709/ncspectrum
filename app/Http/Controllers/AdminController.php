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
    
    /**
     * Authentication Middleware
     *
     * This is the Authentication Middleware.
     * This middleware checks that only authorized users / logged in / Administrators are allowed
     * to access this controller and all its methods.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Administrator Login
     *
     * This method returns the Administrator login view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 		return view('auth.login');
    }

    /**
     * Dashboard
     *
     * This method returns the Administrator Dashboard along with some statistics
     * fetched from the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDashboard()
    {
        $guests = User::where('company', '!=', 'NC-spectrum')->count();
        $employees = User::where('company', '=', 'NC-spectrum')->count();
        $admins = Admin::count();
        $visits = Visit::count();
        $log = Log::count();
        $statuses = DB::table('users')
            ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
            ->where('status','1')
            ->orderBy('firstname')
            ->get();
        $latestVisit = session()->get('latestVisit');

        return view('admins.dashboard', compact('guests', 'employees', 'admins', 'visits', 'statuses', 'log', 'latestVisit'));
    }

    /**
     * Guests Overview
     *
     * This method searches through the database to find all the users with company not equals to 'NC-Spectrum',
     * which means they are guests and not employees.
     * Then returns the guests overview along with the found guests. 
     *
     * @return \Illuminate\Http\Response
     */
    public function showGuests()
    {
        // Eloquent Model User, accesses the 'users' table.
        $guests = User::orderBy('id', 'desc')->where('company','<>','NC-Spectrum')->paginate(20);
        return view('admins.guests')->withGuests($guests);
    }

    /**
     * Guest Visits
     *
     * This methods receives an guest id and then proceeds to find the guest-object
     * and all the visits that the guest has participated in.
     * Then returns a overview of those vistis and the guest itself.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGuestVisits($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $guest = User::find($id);
        $visits = $guest->visits()->orderBy('id','desc')->paginate(20);

        return view ('admins.guestvisits', compact('guest', 'visits'));
    }

    /**
     * Employees Overview
     *
     * This method searches through the database to find all the users with company equals to 'NC-Spectrum',
     * which means they are employees and not guests.
     * Then returns the employees overview along with the found employees. 
     *
     * @return \Illuminate\Http\Response
     */
    public function showEmployees()
    {
        // Eloquent Model User, accesses the 'users' table.
        $employees = User::orderBy('id', 'desc')->where('company','NC-Spectrum')->paginate(20);
        return view('admins.employees')->withEmployees($employees);
    }

    /**
     * Employee Visits
     *
     * This methods receives an employee id and then proceeds to find the employee-object
     * and all the visits that the employee has participated in and all the participating guests to each visit.
     * Then returns a overview of those vistis, visitguests and the employee itself.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEmployeeVisits($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $employee = User::find($id);

        // Finds the visits related to the employee.
        $visits = DB::table('visits')
                    ->where('employee_firstname','=', $employee->firstname)
                    ->where('employee_lastname','=', $employee->lastname)
                    ->orderBy('id','desc')
                    ->paginate(20);

        $guests = array();
        $visitguests = array();
        // Loops through all the fetched visits.
        foreach($visits as $visit)
        {   
            // Finds all the rows with the visit id.
            $guestrows = DB::table('user_visit')
                ->where('visit_id', $visit->id)
                ->get();

            // For each row there is with the given visit id, fetch the corresponding guest that is related.
            foreach($guestrows as $row)
            {
                $guest = DB::table('users')
                ->where('id', $row->user_id)
                ->get();

                // Pushes the guest into an array.
                array_push($guests, $guest);
            }
            // Each visit id will have an array with its participating guests.
            $visitguests[$visit->id][] = $guests;
            // Resets the array before going through a new visit.
            $guests = array();
        }

        return view ('admins.employeevisits', compact('employee', 'visits', 'visitguests'));
    }

    /**
     * Administrators Overview
     *
     * This method searches through the database to find all the administrators,
     * but the administrator with id 1, which is the Super Administrator.
     * He will not be displayed for security reasons.
     * Then returns the administrators overview along with the found administrators. 
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdmins()
    {
        // Eloquent Model Admin, accesses the 'admins' table
        $admins = Admin::orderBy('id', 'desc')->where('id', '!=', 1)->paginate(20);
        return view('admins.admins')->withAdmins($admins);
    }

    /**
     * Vists Overview
     *
     * This method searches through the database to find all the created visits.
     * Along with each found visits, it will then procceed to find the related guests to each visit.
     * Then return the visits overview along with the found vistis and guests for each visit.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVisits()
    {
        // Eloquent Model Visit, accesses the 'visits' table.
        $visits = Visit::orderBy('id','desc')->paginate(20);

        $guests = array();
        $visitguests = array();
        // Loops through all the fetched visits.
        foreach($visits as $visit)
        {   
            // Finds all the rows with the visit id.
            $guestrows = DB::table('user_visit')
                ->where('visit_id', $visit->id)
                ->get();

            // For each row there is with the given visit id, fetch the corresponding guest that is related.
            foreach($guestrows as $row)
            {
                $guest = DB::table('users')
                ->where('id', $row->user_id)
                ->get();

                // Pushes the guest into an array.
                array_push($guests, $guest);
            }
            // Each visit id will have an array with its participating guests.
            $visitguests[$visit->id][] = $guests;
            // Resets the array before going through a new visit.
            $guests = array();
        }

        return view('admins.visits', compact('visits', 'visitguests'));
    }

    /**
     * Administrator Profile
     *
     * This method finds the logged in administrator and returns its profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        // Eloquent way of finding who the currently logged in administrator is.
        $admin = Auth::user();
        return view('admins.profile')->withAdmin($admin);
    }

    /**
     * Status Overview
     *
     * This method keeps track of all the guests that are checked in.
     * On this page the administrator will have the choice to check someone out manually,
     * incase they forgot to check themelves out.
     * The option to manually check someone in is not present, and does not make sense to have either.
     * Returns the status overview with the guests that are checked in.
     *
     * @return \Illuminate\Http\Response
     */
    public function showStatus()
    {
        // Fetches all the users that have status to true, aka checked in.
        $users = DB::table('users')
            ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
            ->where('status','1')
            ->orderBy('firstname')
            ->get();

        $visitors = session()->get('visitors');
        $invisit = array();

        // Matches up with the visitors array to only show the ones that has checked in AND
        // created or is in, a visit.
        if($visitors != null)
        {
            for($i = 0; $i < count($users); $i++)
            {
                if(in_array($users[$i]->id, $visitors))
                {
                    array_push($invisit, $users[$i]);
                } 
            }
        }

        return view ('admins.status')->withUsers($invisit);
    }

    /**
     * Log Overview
     *
     * This fetches the whole 'logs' table and returns the fetched information to the logs overview.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLog()
    {
        // Eloquent Model Log, accesses the 'logs' table
        $log = Log::orderBy('id', 'desc')->paginate(20);
        return view('admins.log')->withLog($log);
    }

    /**
     * Guest Creation Page
     *
     * This method returns a view where the administrator can create a new guest.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateGuest()
    {
        return view('admins.createGuest');
    }

    /**
     * Employee Creation Page
     *
     * This method returns a view where the administrator can create a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateEmployee()
    {
        return view('admins.createEmployee');
    }

    /**
     * Guest Edit Page
     *
     * This method receives a guest id and procceeds to find the guest-object and then
     * return the guest-object to the guest-edit view for editing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditGuest($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $guest = User::find($id);
        return view('admins.editGuest')->withGuest($guest);
    }

    /**
     * Employee Edit Page
     *
     * This method receives an employee id and procceeds to find the employee-object and then
     * return the employee-object to the employee-edit view for editing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditEmployee($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $employee = User::find($id);
        return view('admins.editEmployee')->withEmployee($employee);
    }

    /**
     * Administrator Edit Page
     *
     * This method receives an administrator id and procceeds to find the administrator-object and then
     * return the administrator-object to the administrator-edit view for editing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditAdmin($id)
    {
        // Eloquent Model Admin, accesses the 'admins' table.
        $admin = Admin::find($id);
        return view('admins.editAdmin')->withAdmin($admin);
    }

    /**
     * Administrator Password Edit Page
     *
     * This method receives an administrator id and procceeds to find the administrator-object and then
     * return the administrator-object to the administrator-passwordedit view for editing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditAdminPassword($id)
    {
        // Eloquent Model Admin, accesses the 'admins' table.
        $admin = Admin::find($id);
        return view('admins.editAdminPassword')->withAdmin($admin);
    }

    /**
     * Guest Deletion Page
     *
     * This method receives a guest id and procceeds to find the guest-object and then
     * return the guest-object to the guest-deletion view for deletion.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeleteGuest($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $guests = User::find($id);
        return view('admins.deleteGuest')->withGuest($guests);
    }

    /**
     * Employee Deletion Page
     *
     * This method receives an employee id and procceeds to find the employee-object and then
     * return the employee-object to the employee-deletion view for deletion.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeleteEmployee($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $employees = User::find($id);
        return view('admins.deleteEmployee')->withEmployee($employees);
    }

    /**
     * Administrator Deletion Page
     *
     * This method receives an administrator id and procceeds to find the administrator-object and then
     * return the administrator-object to the administrator-deletion view for deletion.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeleteAdmin($id)
    {
        // Eloquent Model Admin, accesses the 'admins' table.
        $admin = Admin::find($id);
        return view('admins.deleteAdmin')->withAdmin($admin);
    }

    /**
     * Guest Creation
     *
     * This method validates and stores the newly registered guest into the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function storeGuest(Request $request)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'phone' => 'required|unique:users|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-Za-z0-9 \-.]{2,30}$/'
            ]);

        // Validates if the company name is similar to 'NC-Spectrum'.
        $company = strtolower($request->company);
        if (in_array($company, array('nc spectrum', 'nc-spectrum', 'nc.spectrum', 'ncspectrum')))
        {
            Session::flash('error', 'The company name is invalid.');
            return redirect()->back()->withInput(Input::all());
        }

        // Stores and saves the registered data into the database.
        $guest = new User();
        $guest->firstname = ucwords(strtolower($request->firstname));
        $guest->lastname = ucwords(strtolower($request->lastname));
        $guest->phone = $request->phone;
        $guest->email = strtolower($request->email);
        $guest->company = ucwords(strtolower($request->company));
        $guest->save();
        
        // Creates a status along with the new guest.
        $status = new \App\Status();
        $status->status = false;
        $status->updated_at = Carbon::now();
        $guest->status()->save($status);

        // Creates a log entry of this.
        $this->userlog('guest', 'create', $guest->firstname.' '.$guest->lastname);
    
        Session::flash('success', 'The Guest was successfully created!');
        return redirect()->route('admins.guests');
    }

    /**
     * Employee Creation
     * 
     * This method validates and stores the newly registered employee into the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function storeEmployee(Request $request)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'phone' => 'required|unique:users|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'
            ]);

        // Stores and saves the registered data into the database.
        $employee = new User();
        $employee->firstname = ucwords(strtolower($request->firstname));
        $employee->lastname = ucwords(strtolower($request->lastname));
        $employee->phone = $request->phone;
        $employee->email = strtolower($request->email);
        $employee->company = "NC-Spectrum";
        $employee->save();

        // Creates a log entry of this.
        $this->userlog('employee', 'create', $employee->firstname.' '.$employee->lastname);    

        Session::flash('success', 'The Employee was successfully created!');
        return redirect()->route('admins.employees');
    }

    /**
     * Guest Update
     *
     * This method validates and updates the given guest(id) with the newly given values.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function updateGuest(Request $request, $id)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'phone' => 'required|unique:users,phone,'.$id.'|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users,email,'.$id.
                    '|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-Za-z0-9 \-.]{2,30}$/'
            ]);

        // Validates if the company name is similar to 'NC-Spectrum'.
        $company = strtolower($request->company);
        if (in_array($company, array('nc spectrum', 'nc-spectrum', 'nc.spectrum', 'ncspectrum')))
        {
            Session::flash('error', 'The company name is invalid.');
            return redirect()->back()->withInput(Input::all());
        }

        // Finds and updates the guest-object with the new values.
        // Eloquent Model User, accesses the 'users' table.
        $guest = User::find($id);
        $guest->firstname = ucwords(strtolower($request->input('firstname')));
        $guest->lastname = ucwords(strtolower($request->input('lastname')));
        $guest->phone = $request->input('phone');
        $guest->email= strtolower($request->input('email'));
        $guest->company = ucwords(strtolower($request->input('company')));
        $guest->save();

        // Creates a log entry of this.
        $this->userlog('guest', 'update', $guest->firstname.' '.$guest->lastname);

        Session::flash('success', "Changes has been made to the Guest.");
        return redirect()->route('admins.guests');
    }

    /**
     * Employee Update
     *
     * This method validates and updates the given employee(id) with the newly given values.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function updateEmployee(Request $request, $id)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'phone' => 'required|unique:users,phone,'.$id.'|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users,email,'.$id.
                    '|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'
            ]);

        // Finds and updates the employee-object with the new values.
        // Eloquent Model User, accesses the 'users' table.
        $employee = User::find($id);
        $employee->firstname = ucwords(strtolower($request->input('firstname')));
        $employee->lastname = ucwords(strtolower($request->input('lastname')));
        $employee->phone = $request->input('phone');
        $employee->email= strtolower($request->input('email'));
        $employee->company = 'NC-Spectrum';
        $employee->save();

        // Creates a log entry of this.
        $this->userlog('employee', 'update', $employee->firstname.' '.$employee->lastname);

        Session::flash('success', "Changes has been made to the Employee.");
        return redirect()->route('admins.employees');
    }

    /**
     * Administrator Update
     *
     * This method validates and updates the given administrator(id) with the newly given information.
     * Depending on whether the Super Administrator or any other Administrator is being updated, the
     * return URL will differ.
     * The reason behind that is Super Administrator and normal Administrator will have different access rights.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function updateAdmin(Request $request, $id)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-Za-z \-]{2,30}$/',
                'email' => 'required|unique:admins,email,'.$id.
                    '|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'
            ]);

        // Finds and updates the administrator-object with the new values.
        // Eloquent Model Admin, accesses the 'admins' table.
        $admin = Admin::find($id);
        $admin->firstname = ucwords(strtolower($request->input('firstname')));
        $admin->lastname = ucwords(strtolower($request->input('lastname')));
        $admin->email= strtolower($request->input('email'));
        $admin->save();

        // Creates a log entry of this.
        $this->adminlog('update', $admin->firstname.' '.$admin->lastname);

        Session::flash('success', "Changes has been made to the Administrator.");

        // If the current logged in Administrator is the Super Administrator.
        if(Auth::user()->id == 1)
        {
            // If the Super Administrator is updating himself.
            if(Auth::user()->id == $id)
            {
                return redirect()->route('admins.showProfile');
            }
            else
            {
                return redirect()->route('admins.admins');
            }
        }
        else
        {
            return redirect()->route('admins.showProfile');
        }
    }

    /**
     * Administrator Password Update
     *
     * This method validates and updates the administrator password.
     * The passwords saved are all hashed and salted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function updateAdminPassword(Request $request, $id)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'currentPassword' => 'required|min:6|max:60|regex:/^[A-Za-z0-9 \-._]{6,60}$/',
                'password' => 'required|min:6|max:60|regex:/^[A-Za-z0-9 \-._]{6,60}$/|confirmed',
                'password_confirmation' => 'required|min:6|max:60|regex:/^[A-Za-z0-9 \-._]{6,60}$/',
            ]);

        // Eloquent Model Admin, accesses the 'admins' table.
        $admin = Admin::find($id);
        $sysadmin = Admin::find(1);

        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('password');

        // Sets the password that is currently saved in the database.
        if(Auth::user()->id == 1)
        {
            $databasePassword = $sysadmin->password;
        }
        else
        {
            $databasePassword = $admin->password;
        }

        // Checks the hash+salt value between the given 'current password' 
        // and the hashed+salted password that is currently saved in the database.
        // This is to check if the passwords match.
        if(Hash::check($currentPassword, $databasePassword))
        {
            // Checks the hash+salt value of the 'new password'
            // and the hashed+salted password that is currently saved in the database.
            // This is to check the new password is not the same as the currently saved one.
            if(Hash::check($newPassword, $databasePassword))
            {        
                // If it is the Super Administrator trying to edit passwords.
                // The new password can not be equal to the System Administrators password.
                if(Auth::user()->id == 1)
                {
                    Session::flash('error', 'The new password can not be equal to the System Administrator password.');
                }
                // If it is any other Administrator trying to edit password.
                // The new password can not be equal to their own current password.
                else
                {
                    Session::flash('error', 'The new password can not be equal to your current password.');
                }
                return redirect()->back();
            }
            else
            {
                // Hashes, adds salt and saves the new password.
                $password = bcrypt($newPassword);
                $admin->password = $password;
                $admin->save();

                // Creates a log entry of this.
                $this->adminlog('password', $admin->firstname.' '.$admin->lastname);

                Session::flash('success', 'The password has been successfully updated!');
                // Depending on if it is the Super Administrator that is logged in, the return view is different. 
                // Different Access Rights.
                if(Auth::user()->id == 1)
                {
                    // If the Super Administrator is editing his own password.
                    if(Auth::user()->id == $id)
                    {
                        return redirect()->route('admins.showProfile');
                    }
                    else
                    {
                        return redirect()->route('admins.admins');
                    }
                }
                else
                {
                    return redirect()->route('admins.showProfile');
                }
            }
        }
        else
        {
            Session::flash('error', 'The password is not correct.');
            return redirect()->back();
        }
    }

    /**
     * Guest Deletion
     *
     * This method deletes the given guest and detaches any relations.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGuest($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $guest = User::find($id);
        $guest->visits()->detach();
        $guest->status()->delete();
        $guest->delete();

        // Creates a log entry of this.
        $this->userlog('guest', 'delete', $guest->firstname.' '.$guest->lastname);

        Session::flash('success', 'The Guest was successfully deleted!');
        return redirect()->route('admins.guests');
    }

    /**
     * Employee Deletion
     *
     * This method deletes the given employee and detaches any relations.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEmployee($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $employee = User::find($id);
        $employee->visits()->detach();
        $employee->delete();

        // Creates a log entry of this
        $this->userlog('employee', 'delete', $employee->firstname.' '.$employee->lastname);

        Session::flash('success', 'The Employee was successfully deleted!');
        return redirect()->route('admins.employees');
    }

    /**
     * Administrator Deletion
     *
     * This method deletes the given administrator
     * after confirming the password of Super Administrator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin(Request $request, $id)
    {
        // Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'password' => 'required|min:6|max:60|regex:/^[A-Za-z0-9 \-._]{6,60}$/',
            ]);

        // Eloquent Model Admin, accesses the 'admins' table.
        $admin = Admin::find($id);
        $sysadmin = Admin::find(1);

        // Fetches Super Administrators password from the database.
        $databasePassword = $sysadmin->password;
        $password = $request->input('password');

        // Checks given password matches the currently saved password in the database.
        if(Hash::check($password, $databasePassword))
        {
            $admin->delete();

            // Creates a log entry of this.
            $this->adminlog('delete', $admin->firstname.' '.$admin->lastname);

            Session::flash('success', 'The Administrator has been successfully deleted!');
            return redirect()->route('admins.admins');
        }
        else
        {
            Session::flash('error', 'The password is not correct.');
            return redirect()->back();
        }
    }

    /**
     * Status check-out
     *
     * This method is called whenever an Administrator manually checks out a guest.
     * This method will update the guests status and remove the guest id from the backend session arrays
     * that keeps track of who is checked-in.
     * Note this session variable is mostly used in the UserController.
     *
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function checkout($id)
    {
        // Eloquent Model User, accesses the 'users' table.
        $guest = User::find($id);
        $guest->status()->update(['status' => false, 'updated_at' => Carbon::now()]);

        // Fetches the session variable that keeps track of who's checked-in and removes the given guest id from the arrays.
        $userlist = session()->get('userlist');
        $visitors = session()->get('visitors');

        if(!empty($userlist))
        {
            $index = array_search($guest->id, $userlist);
            if($index !== false)
            {
                array_splice($userlist,$index,1);
                session()->put('userlist', $userlist);
            }
        }
        if(!empty($visitors))
        {
            $index = array_search($guest->id, $visitors);
            if($index !== false)
            {
                array_splice($visitors,$index,1);
                session()->put('visitors', $visitors);
            }
        }

        return redirect('admin/status');
    }

    /**
     * Avatar Upload
     *
     * This method is called when an Administrator wants to upload a new profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        // Checks if there is a file/image chosen.
        if($request->hasFile('avatar'))
        {
            // Finds the currently logged in administrator.
            $admin = Admin::find(Auth::user()->id);
            $avatar = $request->file('avatar');
            // Renames the picture using the datetime() function in PHP.
            $filename = time().'.'.$avatar->getClientOriginalExtension();

            // If administrators current picture is not the default, delete it.
            if($admin->avatar !== 'default.jpg')
            {
                $file = public_path('uploads/avatars/'.$admin->avatar);
                if(File::exists($file))
                {
                    unlink($file);
                }
            }

            // Resizes the image and saves it.
            Image::make($avatar)->fit(300, 300)->save(public_path('uploads/avatars/'.$filename));

            // Saves the new profile picture.
            $admin = Auth::user();
            $admin->avatar = $filename;
            $admin->save();

            // Create a log entry of this.
            $this->adminlog('avatar', $admin->firstname.' '.$admin->lastname);                

            return view('admins.profile')->withAdmin($admin);
        }
        else
        {
            Session::flash('error', 'You must upload a picture!');
            return redirect()->back();
        }
    }

    /**
     * Userlog
     *
     * This method is used to to make log entries. 
     * This method is used in all methods that do changes to guests or employees.
     *
     * @param  string  $role
     * @param  string  $type
     * @param  string  $user
     * @return null
     */
    public function userlog($role, $type, $user)
    {
        $log = new Log();

        // Trims away unnecessary spaces.
        $admin = trim(Auth::user()->firstname.' '.Auth::user()->lastname);
        $role = ucfirst(strtolower($role));

       // Creates the log entry based on the status/log type.
        switch ($type) 
        {
            case 'create':
                $data = 'Admin: '.$admin.', created '.$role.': '.$user.'.';
                break;
            case 'update':
                $data = 'Admin: '.$admin.', updated '.$role.': '.$user.'.';
                break;
            case 'delete':
                $data = 'Admin: '.$admin.', deleted '.$role.': '.$user.'.';
                break;
        }

        // Creates and saves the log entry.
        $log->type = $type;
        $log->information = $data;
        $log->created_at = Carbon::now();
        $log->save();
    }

    /**
     * Administratorlog
     *
     * This method is used to to make log entries. 
     * This method is used in all methods that do changes to administrators.
     *
     * @param  string  $type
     * @param  string  $user
     * @return null
     */
    public function adminlog($type, $user)
    {
        $log = new Log();

        // Trims away unnecessary spaces.
        $admin = trim(Auth::user()->firstname.' '.Auth::user()->lastname);
        $user = trim($user);

        // Creates the log entry based on the status/log type.
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

        // Creates and saves the log entry.
        $log->type = $type;
        $log->information = $data;
        $log->created_at = Carbon::now();
        $log->save();
    }

    /**
    * Livesearch
    *
    * This method is called from an AJAX request.
    * This method is called whenever an administrator types into the livesearch field.
    * The method will try to look for the specified user thats being searched and return it, if found.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function search(Request $request)
    {        
        // If it is an AJAX request type.
        if($request->ajax())
        {
            // Fetches the sent data.
            $search = $request->search;
            $type = $request->type;
            $output = "";

            // If the search is for administrators.
            if($type === 'admins')
            {
                // Means the there are values in the inputfield.
                if($search != "")
                {
                    // Does a database search of firstname and lastname by the given values.
                    $admins = DB::table('admins')
                        ->where('id', '!=', 1)
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->get();
                }
                // Means there are no values, aka the administrator has deleted all the values in the inputfield.
                else
                {
                    // No more values, returns the default result.
                    $admins = Admin::orderBy('id', 'desc')->where('id', '!=', 1)->get();
                }

                // Creates the output thats to be displayed in the view.
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

            // If the search is for guests.
            elseif($type === 'guests')
            {
                // Means the there are values in the inputfield.
                if($search != "")
                {
                    // Does a database search of firstname, lastname and company by the given values.
                    $guests = DB::table('users')
                        ->where('company', 'not like', 'NC-Spectrum')
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->orWhere('company', 'like', '%'.$search.'%')
                        ->where('company', 'not like', 'NC-Spectrum')
                        ->get();
                }
                // Means there are no values, aka the user has deleted all the values in the inputfield.
                else
                {
                    // No more values, returns the default result.
                    $guests = User::orderBy('id', 'desc')->where('company','not like','NC-Spectrum')->get();
                }

                // Creates the output thats to be displayed in the view.
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

            // If the search is for employees.
            else
            {
                // Means the there are values in the inputfield.
                if($search != "")
                {
                    // Does a database search of firstname and lastname by the given values.
                    $employees = DB::table('users')
                        ->where('company', 'like', 'NC-Spectrum')
                        ->where('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->where('company', 'like', 'NC-Spectrum')
                        ->get();
                }
                // Means there are no values, aka the user has deleted all the values in the inputfield.
                else
                {
                    // No more values, returns the default result.
                    $employees = User::orderBy('id', 'desc')->where('company','like','NC-Spectrum')->get();
                }

                // Creates the output thats to be displayed in the view.
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

            // If the output is empty, means the search did not find any matches.
            if($output == "")
            {
                $output = "<td colspan='5' id='notfound'>".
                            "<div class='margin-top text-center'>".
                                "<i><strong><u>".$search."</u></strong> was not found</i>".
                            "</div>".
                          "</td>";
                return Response($output);
            }
            else
            {
                return Response($output);
            }   
        }
    }

}