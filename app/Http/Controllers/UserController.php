<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\Status;
use App\Visit;
use Session;
use DB;

class UserController extends Controller
{
    /**
     * Homepage
     *
     * This method connects to the database and fetches the users with a specific status. 
     * We then proceed to return the mainpage view along with the found users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Laravels Eloquent Database query
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

            $userlist = session()->get('userlist');

        return view('users.index', compact('usersout', 'usersin'));
    }

    /**
     * User Creation Pagge
     *
     * This method returns the view of the usercreation page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Visit Creation Page
     *
     * This method preforms a backend check of how many users are in the checkin list.
     * If the list is not empty, it then proceeds to find each user in the database, 
     * along with finding all the employees. 
     * The collected users and employees will be sent to the visit creation view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function visit(Request $request)
    {
        // Worth noting this array only keeps the id of each user, not the whole object.
        $userlist = session()->get('userlist');
        $users = array();

        // Checks if the array is empty, if so, returns to the same view with an error message.
        if(empty($userlist))
        {
            Session::flash('error', 'You must check-in users before creating a visit.');
            return redirect()->route('users.index');
        }

        // Finds the userobjects based on the ids in the array.
        for($i=0;$i<count($userlist);$i++)
        {
            // Eloquent Model User, accesses the 'users' table.
            $user = User::find($userlist[$i]);
            array_push($users, $user);
        }

        // Eloquent Model User, accesses the 'users' table.
        // Finds the employees the users can choose among.
        $employees = User::orderBy('firstname')->where('company','NC-Spectrum')->get();

        return view('users.visit', compact('users', 'employees'));      
    }

    /**
     * User Creation
     *
     * This method validates and stores the newly registered user into the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function storeUser(Request $request)
    {
    	// Backend validation rules. 
        // Data sent from the view is in the $request variable.
        $this->validate($request, [
                'firstname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'lastname' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå \-]{2,30}$/',
                'phone' => 'required|unique:users|min:8|max:8|regex:/^[0-9]{8}$/',
                'email' => 'required|unique:users|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆØÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);
        
        // Validates if the company name is similar to 'NC-Spectrum'.
        $company = strtolower($request->company);
        if (in_array($company, array('nc spectrum', 'nc-spectrum', 'nc.spectrum', 'ncspectrum')))
        {
            Session::flash('error', 'The company name is invalid.');
            return redirect()->back()->withInput(Input::all());
        }

        // Stores and saves the registered data into the database.
        $user = new User();
    	$user->firstname = ucwords(strtolower($request->firstname));
    	$user->lastname = ucwords(strtolower($request->lastname));
    	$user->phone = $request->phone;
    	$user->email = strtolower($request->email);
    	$user->company = ucwords(strtolower($request->company));
        $user->save();

        // Creates a status along with the new user.
        $status = new \App\Status();
        $status->status = false;
        $user->status()->save($status);
    
        Session::flash('success', 'The User was successfully created!');

    	return redirect()->route('users.index');
    }

    /**
     * Visit Creation
     *
     * This method is used to store a newly created visit.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function storeVisit(Request $request)
    {
        // Fetches the data sent from the view, $request variable.
        $userids = $request->users;
        $employeeid = $request->employees;
        $hours = $request->hours;
        $minutes = $request->minutes;

        // Backend validation.
        if($employeeid == null)
        {
            Session::flash('error', 'You must choose an employee before continuing!');
            return redirect()->route('users.visit');
        }
        if(($hours == null && $minutes == null) || ($hours == 0 && $minutes == 0))
        {
            Session::flash('error', 'You must set the visit time before continuing!');
            return redirect()->route('users.visit');
        } 

        // Eloquent Model User, accesses the 'users' table.
        // Finds the employee object based on the sent employee id.
        $employee = User::find($employeeid);

        // Creates a visit that is to be stored in the database.
        $visit = new Visit();
        $visit->employee_firstname = $employee->firstname;
        $visit->employee_lastname = $employee->lastname;

        // Records the most recent visit date-time into a session variable
        $now = Carbon::now();
        session()->put('latestVisit', $now);

        $visit->from = $now;
        $to = Carbon::now();;
        $to = $to->addHour($hours);
        $to = $to->addMinutes($minutes);
        $visit->to = $to;
        $visit->save();

        // Each participating user will acquire a row with the newly created visit's id.
        foreach($userids as $userid)
        {       
            // Eloquent Model User, accesses the 'users' table.
            $user = User::find($userid);
            $user->visits()->save($visit);
        }

        Session::flash('success', 'The Visit has been successfully registered!');

        return redirect()->route('users.index');
    }

    /**
     * Userlist
     *
     * This method is called from an AJAX request.
     * When the checkin button is clicked and the users are redirected to the visit creation page,
     * the array containing every (participating) users id is sent here and stored in a session variable.
     * This session variable will be used in other methods to keep track of who the participants are.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userlist(Request $request)
    {
        $userlist = $request->data;
        session()->put('userlist', $userlist);

        return response()->json();
    }

    /**
     * Status in
     *
     * This method is called upon by an AJAX request whenever a user checks in.
     * 'Drags from the checkout list to checkin list'.
     * Updates the given users status and 'updated_at' timestamp.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusin(Request $request)
    {
        $userid = $request->data;

        // Checks in the status and updates the timestamp.
        $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => true, 'statuses.updated_at' => Carbon::now()]);

        return response()->json();
    }

    /**
     * Status out
     *
     * This method is called upon by an AJAX request whenever a user checks out.
     * 'Drags from the checkin list to checkout list'.
     * Updates the given users status and 'updated_at' timestamp.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusout(Request $request)
    {
        $userid = $request->data;
        $userlist = session()->get('userlist');
        // Removes the userid from the array of checked in users.
        if(!empty($userlist))
        {
            $index = array_search($userid, $userlist);
            array_splice($userlist,$index,1);
            session()->put('userlist', $userlist);
        }

        // Checks out the status and updates the timestamp.
        $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => false, 'statuses.updated_at' => Carbon::now()]);

        return response()->json();
    }

    /**
     * Automatic Synchronization
     *
     * This method is called from an AJAX request.
     * This method is called in a set interval (set in userscript.js).
     * The whole purpose is to send the backend userlist to the frontend to 
     * synchronize and see if there are any missmatches. 
     * By missmatch this method is refering to if an administrator manually checks out a guest,
     * in that case the backend array is updated, but the frontend variables are not.
     * Hence we need to send the backend array to update the frontend variables.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autosync(Request $request)
    {
        $userlist = session()->get('userlist');
        return response($userlist);
    }

    /**
     * List Synchronization
     *
     * This method is called from an AJAX request.
     * Whenever there is a missmatch in the various frontend variables that keeps track of who is checked in or out,
     * there is probably an error which can not be fixed unless we reset the variables.
     * This is most likely caused by an unforseen user error or administrator error.
     * This method will reset the backend variables and statuses, and respond to the AJAX request so the
     * frontend variables also get reset before refreshing the users homepage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listsync(Request $request)
    {
        // Fetches the backend array of checked in users.
        $userlist = session()->get('userlist');

        // Changes their status to false.
        foreach($userlist as $userid)
        {
            $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => false, 'statuses.updated_at' => Carbon::now()]);
        }

        // Creates a new empty array.
        $reset = array();
        session()->put('userlist', $reset);
        return Response('');
    }

    /**
    * Livesearch
    *
    * This method is called from an AJAX request.
    * This method is called whenever a user types into the livesearch field.
    * The method will try to look for the specified user thats being searched and return it, if found.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function usersearch(Request $request)
    {        
        // If it is an AJAX request type.
        if($request->ajax())
        {
            $search = $request->usersearch;
            $output = "";

            // Means the there are values in the inputfield.
            if($search != "")
            {
                // Does a database search of firstname, lastname and company by the given values.
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
            // Means there are no values, aka the user has deleted all the values in the inputfield.
            else
            {
                // No more values, returns the default result.
                $users = DB::table('users')
                    ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                    ->where('status', false)
                    ->where('company','not like','NC-Spectrum')
                    ->orderBy('id','desc')
                    ->paginate(5);
            }

            // Creates the output thats to be displayed in the view.
            foreach($users as $user)
            {
                $output.=
                    '<li class="userbox" id="out">'.
                    '<div id="userid" hidden>'.$user->id.'</div>'.
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

            // If no users are found.
            if($output == "")
            {
                $output = "<div class='margin-top text-center' id='notfound'>".
                            "<i><strong><u>".$search."</u></strong> was not found</i>".
                          "</div>";
                return Response($output);
            }
            // One or more users found.
            else
            {
                return Response($output);
            }   
        }
    }
}
