<?php

namespace App\Http\Controllers;

use App\Hierachy;
use App\LeaveBalance;
use App\Mail\ApproveLeave;
use App\Mail\RejectLeave;
use Illuminate\Support\Facades\Mail;
use Vinn\Repository\ProcessLeaveRepo;
use App\LeaveDay;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Leave;
use App\Http\Requests\LeaveRequest;
use App\User;
use App\LeaveType;
use Auth;
use Carbon\Carbon;
use Session;


class LeaveController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::user()->role->role_permission('view_leaves'))
        {
            if (Auth::user()->role->role_permission('view_leaves')->level == 'all')
            {
                $leaves = Leave::paginate(30);
            } elseif (Auth::user()->role->role_permission('view_leaves')->level == 'team')
            {
                $users = User::where('department_id', Auth::user()->department_id)->pluck('id');
                $leaves = Leave::whereIn('user_id', $users)->paginate(30);
            } else
            {
                $leaves = Leave::where('user_id', Auth::user()->id)->paginate(30);
            }

            return view('leaves.index', compact('leaves'));
        } else
        {
            abort(403);
        }
    }

    public function search(Request $request)
    {
        if (Auth::user()->role->role_permission('view_leaves'))
        {
            if (Auth::user()->role->role_permission('view_leaves')->level == 'all')
            {
                $users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%' . $request->get('term') . '%'])->get();
                $leaves = Leave::whereIn('user_id', $users->pluck('id'))->paginate(30);
            } elseif (Auth::user()->role->role_permission('view_leaves')->level == 'team')
            {
                $users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%' . $request->get('term') . '%'])->where('department_id', Auth::user()->department_id)->pluck('id');
                $leaves = Leave::whereIn('user_id', $users)->paginate(30);
            } else
            {
                $users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%' . $request->get('term') . '%'])->where('id', Auth::user()->id)->pluck('id');
                $leaves = Leave::whereIn('user_id', $users)->paginate(30);
            }

            return view('leaves.index', compact('leaves'));
        } else
        {
            abort(403);
        }
    }

    public function create(User $user)
    {

         $types = [
             LeaveType::FULL_PAID,
             LeaveType::HALF_PAID,
             LeaveType::NON_PAID
         ];

            $leave_types = ['' => ''] + LeaveType::pluck('leave_type', 'id')->toArray();
            $staffs = User::all();
            $leave = LeaveType::first();
            return view('leaves.create', compact('user', 'leave_types','staffs','leave','types'));

    }

    public function daysRemaining($leave_id)
    {
        $days_no = 0;
         $days = LeaveDay::where('user_id', Auth::id())->where('leave_type_id', $leave_id)->first();
        if ($days){
            $days_no=$days->remaining_leaves;
        }
        return response()->json($days_no);
    }

    public function getLeaveType($id)
    {

        $lv = LeaveType::where('id',$id)
            ->where('leave_type','like','sick'.'%')->first();
        if ($lv){
            return response('found');
        }else{
            return response('notfound');
        }

    }

    public function store(LeaveRequest $request, User $user)
    {
//dd($request->all());
        $user = Hierachy::where('user_id',Auth::id())->first();
        if(!$user->manager){
            Session::flash('fail','Sorry, You must be set in the hierachy first.');
            return redirect()->back();
        }
          ProcessLeaveRepo::process()->startProcess($request->all());
             Mail::to($user->manager->email)
            ->cc($user->supervisor->email)
            ->send(new ApproveLeave([
            'user' => User::find(Auth::id()),
            'manager' =>$user->manager,
            'url' => url('leaves')
        ]));


        Session::flash('success', 'Leave has been saved.');
        return redirect('leaves');
    }

    public function show(Leave $leave)
    {
        if (Auth::user()->role->role_permission('view_leaves'))
        {
            if (Auth::user()->role->role_permission('view_leaves')->level == 'team')
            {
                $users = User::where('department_id', Auth::user()->department_id)->pluck('id');
                $leave = Leave::where('id', $leave->id)->whereIn('user_id', $users)->first();
            } elseif (Auth::user()->role->role_permission('view_leaves')->level == 'self')
            {
                $leave = Leave::where('id', $leave->id)->where('user_id', Auth::user()->id)->first();
            }

            return $leave ? $leave : abort(403);
        } else
        {
            abort(403);
        }
    }

    public function edit($id)
    {

        $types = [
            LeaveType::FULL_PAID,
            LeaveType::HALF_PAID,
            LeaveType::NON_PAID
        ];

          $leave = Leave::find($id);
           $leave_types = ['' => ''] + LeaveType::pluck('leave_type', 'id')->toArray();
           $staffs = User::all();
           return view('leaves.edit', compact('leave', 'leave_types','staffs'))->with('types',$types);

        }
	
    public function update(Request $request,$id)
    {

        ProcessLeaveRepo::process()->updateProcess($request->all());

        Session::flash('success', 'Leave has been updated.');
        return redirect('leaves');


    }
	
    public function destroy($id)
    {

          $leave = Leave::find($id);
			$leave->delete();
			return redirect('leaves')->withSuccess('Leave has been deleted.');

    }

    public function Approve($id)
    {
        $leave = Leave::findOrFail($id);
        $user = Hierachy::where('user_id',$leave->user->id)->first();

       $leave->update(['status' => 1]);
        Mail::to($leave->user->email)
            ->cc($user->supervisor->email)
            ->send(new ApproveLeave([
            'url' => url('leaves'),
            'user' => $leave->user

        ]));
        Session::flash('success','Leave successfully approved.');
        return redirect()->back();

    }

    public function Reject($id)
    {

        $leave = Leave::findOrFail($id);
        $user = Hierachy::where('user_id',$leave->user->id)->first();
        Mail::to($leave->user->email)
            ->cc($user->supervisor->email)
            ->send(new RejectLeave([
                'url' => url('leaves'),
                'user' => $leave->user
            ]));

         $leave->update(['status' => 2]);
        Session::flash('success','Leave successfully rejected.');
        return redirect()->back();
    }
        public function leaveCalender()
    {

        return view('leaves.leave-calender')->with('leaves',Leave::all());
    }


}
