<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log as Logger;
use Carbon\Carbon;
use App\User;
use App\Status;
use App\Visit;
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
                'email' => 'required|unique:users|regex:/^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆØÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$/',
                'company' => 'required|min:2|max:30|regex:/^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$/'
            ]);
        
        $company = strtolower($request->company);
        if (in_array($company, array('nc spectrum', 'nc-spectrum', 'nc.spectrum', 'ncspectrum')))
        {
            Session::flash('error', 'The company name is invalid.');
            return redirect()->back()->withInput(Input::all());
        }

        $user = new User();
    	$user->firstname = ucwords(strtolower($request->firstname));
    	$user->lastname = ucwords(strtolower($request->lastname));
    	$user->phone = $request->phone;
    	$user->email = strtolower($request->email);
    	$user->company = ucwords(strtolower($request->company));
        $user->save();

        $status = new \App\Status();
        $status->status = false;
        $user->status()->save($status);
    
        Session::flash('success', 'The User was successfully created!');

    	return redirect()->route('users.index');
    }

    public function visit(Request $request)
    {
        $userlist = session()->get('userlist');
        $users = array();

        if(empty($userlist))
        {
            Session::flash('error', 'You must check-in users before creating a visit.');
            return redirect()->route('users.index');
        }

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
        $userids = $request->users;
        $employeeid = $request->employees;
        $hours = $request->hours;
        $minutes = $request->minutes;

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

        $employee = User::find($employeeid);

        $visit = new Visit();
        $visit->employee_firstname = $employee->firstname;
        $visit->employee_lastname = $employee->lastname;

        $visit->from = Carbon::now();
        $to = Carbon::now();
        $to = $to->addHour($hours);
        $to = $to->addMinutes($minutes);
        $visit->to = $to;

        $visit->save();

        foreach($userids as $userid)
        {       
            $user = User::find($userid);
            $user->visits()->save($visit);
        }

        Session::flash('success', 'The Visit has been successfully registered!');

        return redirect()->route('users.index');
    }

    public function userlist(Request $request)
    {
        $userlist = $request->data;
        session()->put('userlist', $userlist);

        return response()->json();
    }

    public function listsync(Request $request)
    {
        $users = session()->get('userlist');
        return Response($users);
    }

    public function statusin(Request $request)
    {
        $userid = $request->data;

        $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => true, 'statuses.updated_at' => Carbon::now()]);

        return response()->json();
    }

    public function statusout(Request $request)
    {
        $userid = $request->data;
        $userlist = session()->get('userlist');
        if(!empty($userlist))
        {
            $index = array_search($userid, $userlist);
            array_splice($userlist,$index,1);
            session()->put('userlist', $userlist);
        }

        $user = DB::table('users')
                ->leftjoin('statuses', 'users.id', '=', 'statuses.user_id')
                ->where('id', $userid)
                ->update(['status' => false, 'statuses.updated_at' => Carbon::now()]);

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

            if($output == "")
            {
                $output = "<div class='margin-top text-center' id='notfound'><i><strong>".$search."</strong> was not found</i></div>";
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
