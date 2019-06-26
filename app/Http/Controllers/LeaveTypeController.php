<?php

namespace App\Http\Controllers;

use App\Department;
use App\Leave;
use App\LeaveDay;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LeaveType;
use App\Http\Requests\LeaveTypeRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

            $leave_types = LeaveType::paginate(30);
            return view('leave-types.index', compact('leave_types'));

    }

    public function search(Request $request)
    {

            $leave_types = LeaveType::where('leave_type', 'LIKE', '%' . $request->get('term') . '%')->paginate(30);
            return view('leave-types.index', compact('leave_types'));

    }

    public function create()
    {


            return view('leave-types.create')->with('staff', User::all())->with('departments', Department::all())->with('staffs', User::all());

    }

    public function store(LeaveTypeRequest $request)
    {


            $leave_type = LeaveType::create([
                'leave_type' => $request->get('leave_type'),
                'selected_by' => $request->get('selected_by'),
                'backstopper_id' => $request->get('back-stop'),
                'gender' => $request->get('gender'),
                'count_start_half_day' => $request->get('count_start_half_day'),
                'count_end_half_day' => $request->get('count_end_half_day'),
                'carried_forward' => $request->get('carried_forward') ? $request->get('carried_forward') : 0,
                'encashed' => $request->get('encashed') ? $request->get('encashed') : 0,
                'count_days' => $request->get('count_days') ?  $request->get('count_days') : 0

            ]);
            if($request->has('staff_type_id')) {
                $leave_type->staffs()->attach($request->get('staff_type_id'));
            }
        if($request->has('designation')) {
            $leave_type->departments()->attach($request->get('designation'));
        }
            return redirect('leave-types')->withSuccess($leave_type->leave_type . ' has been saved.');

    }

    public function show(LeaveType $leave_type)
    {
        if (Auth::user()->role->role_permission('view_leave_types')) {
            return $leave_type;
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
       $leave_type = LeaveType::findOrFail($id);

       return view('leave-types.edit', compact('leave_type'))->with('staff', User::all())->with('departments', Department::all())->with('staffs', User::all());;

    }

    public function update()
         {
            // dd(request()->all());
            $leave_type = LeaveType::findOrFail(request()->get('id'));
            $leave_type->leave_type = request()->get('leave_type');
            $leave_type->selected_by = request()->get('selected_by');
            $leave_type->backstopper_id = request()->get('backstopper_id');
            $leave_type->gender = request()->get('gender');
            $leave_type->count_days = request()->get('count_days');
            $leave_type->count_start_half_day = request()->get('count_start_half_day');
            $leave_type->count_end_half_day = request()->get('count_end_half_day');
            $leave_type->carried_forward = request()->get('carried_forward');
            $leave_type->encashed = request()->get('encashed');

            $leave_type->save();
            if(request()->has('staff_type_id')) {
                $leave_type->staffs()->sync(request()->get('staff_type_id'));
            }
            if(request()->has('designation')) {
                $leave_type->departments()->sync(request()->get('designation'));
            }

        return redirect('leave-types')->withSuccess('leave type with id ' . request()->get('id') . ' has been updated.');


    }

    public function destroy($id)
    {

        LeaveType::find($id)->delete();
            return redirect('leave-types')->withSuccess('leave type has been deleted.');

    }

    public function assignLeave()
    {


        return view('leave-types.assign')->with('leave_types', LeaveType::all());
    }

    public function usersAttachedApi($id)
    {
        $leaves = LeaveType::where('id', $id)->first();
          if ($leaves->selected_by == 'by_gender'){

             return response()->json(User::where('gender',strtoupper($leaves->gender))->get());
         }
        if ($leaves->selected_by == 'by_staff'){

            return response()->json($leaves->staffs);
        }
       if ($leaves['selected_by'] == 'by_designation') {
           return response()->json(User::where('department_id',$leaves->designation)->get());
          }
        if ($leaves['selected_by'] == 'by_all') {
            return response()->json(User::get());
        }


    }

    public function saveDays()
    {
        $leave_no = LeaveDay::where('leave_type_id', request()->get('leave_type'))
            ->where('user_id', request()->get('staff_id'))->first();
        if (request()->get('close')) {

            LeaveDay::where('leave_type_id', request()->get('leave_type'))
                ->where('user_id', request()->get('staff_id'))->update(['remaining_leaves' => 0]);
            Session::flash('success','Days successfully reseted to zero');
            return redirect()->back();

        }

        if ($leave_no != null) {

            LeaveDay::where('leave_type_id', request()->get('leave_type'))
                ->where('user_id', request()->get('staff_id'))->increment('remaining_leaves',request()->get('leaves_no'));
            Session::flash('success','Days successfully updated.');
            return redirect()->back();
        }

        $this->validate(request(), [
            'staff_id' => 'required',
            'leave_type' => 'required',
            'leaves_no' => 'required',

        ]);

        LeaveDay::create([
            'user_id' => request()->get('staff_id'),
            'leave_type_id' => request()->get('leave_type'),
            'leaves_no' => request()->get('leaves_no'),
            'remaining_leaves' => request()->get('leaves_no'),
            'can_exceed_limit' => request()->get('can_exceed_limit')
        ]);

        return redirect()->back();


    }

    public function backStop($id)
    {
        $leave_type  = LeaveType::findOrFail($id)->backstopper_id;

        return response()->json($leave_type);
}
}
