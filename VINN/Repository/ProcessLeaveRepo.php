<?php
/**
 * Created by PhpStorm.
 * User: vinnyvinny
 * Date: 11/23/18
 * Time: 4:26 PM
 */

namespace Vinn\Repository;

use App\LeaveLog;
use Auth;
use App\Leave;
use App\LeaveDay;
use Carbon\Carbon;
use Session;

class ProcessLeaveRepo
{
    static function process()
    {
        return new self();
    }

    public function startProcess($leave_data)
    {

      $user_id = $leave_data['emp_id'] ? $leave_data['emp_id'] : Auth::user()->id;
        $now = Carbon::parse($leave_data['date_from']);
        $end = $leave_data['date_to'];
        $days_no = LeaveDay::where('user_id', $user_id)->where('leave_type_id', $leave_data['leave_type_id'])->first();
        $rm_days =  $days_no ? $days_no->remaining_leaves : 0;
        if ($now->diffInDays($end) >$rm_days ) {

            Session::flash('fail', 'Sorry, You do not have enough leave days remaining');
            return redirect('/leaves');
        }
        LeaveDay::find($days_no->id)->decrement('remaining_leaves', $now->diffInDays($end));

        self::getDays($leave_data, $now->diffInDays($end),LeaveDay::find($days_no->id)->remaining_leaves);

    }

    public function updateProcess($leave_data)
    {


        $now = Carbon::parse($leave_data['date_from']);
        $end = $leave_data['date_to'];
        $days_no = LeaveDay::where('user_id', Auth::user()->id)->where('leave_type_id', $leave_data['leave_type_id'])->first();
        $rm_days =  $days_no ? $days_no->remaining_leaves : 0;
        if ($now->diffInDays($end) >$rm_days ) {

            Session::flash('fail', 'Sorry, You do not have enough leave days remaining');
            return redirect('/leaves');
        }
        LeaveDay::find($days_no->id)->decrement('remaining_leaves', $now->diffInDays($end));

        self::updateDays($leave_data, $now->diffInDays($end),LeaveDay::find($days_no->id)->remaining_leaves);

    }

    public function getDays($leave_data, $total_days,$remaining_days)
    {

                Leave::create([
                'user_id' => $leave_data['emp_id'] ? $leave_data['emp_id'] : $leave_data['user_id'],
                'leave_type_id' => $leave_data['leave_type_id'],
                'date_from' => $leave_data['date_from'],
                'date_to' => $leave_data['date_to'],
                'applied_on' => $leave_data['applied_on'],
                'reason' => $leave_data['reason'],
                'comment' => $leave_data['comment'],
                'staff_id' => $leave_data['staff_id'],
                'leave_no' => $total_days,
                'remaining_days' => $remaining_days

            ]);

    }



    public function updateDays($leave_data, $total_days,$remaining_days)
    {
        Leave::findOrFail($leave_data['id'])->update([
            'user_id' => $leave_data['user_id'],
            'leave_type_id' => $leave_data['leave_type_id'],
            'date_from' => $leave_data['date_from'],
            'date_to' => $leave_data['date_to'],
            'applied_on' => $leave_data['applied_on'],
            'reason' => $leave_data['reason'],
            'comment' => $leave_data['comment'],
            'staff_id' => $leave_data['staff_id'],
            'leave_no' => $total_days,
            'remaining_days' => $remaining_days
        ]);

    }

    public function getLeaves()                                                                                                                                     
    {
        $leave_days = LeaveDay::all();
        $all_leaves =[];

        foreach ($leave_days as $ld){
            $leaves_found = Leave::where('leave_type_id',$ld->leave_type_id)->where('user_id',$ld->user_id)->get();
            foreach ($leaves_found as $lf){
                   $all_leaves []= [
                    'id' =>$lf->id,
                    'user_id' => $lf->user_id,
                    'leave_type' =>$lf->leave_type->leave_type,
                    'username' => $lf->user->first_name .' '. $lf->user->last_name,
                    'date_from' =>$lf->date_from,
                    'date_to' =>$lf->date_to,
                    'leaves_no' => $lf->leave_no,
                    'leaves_bal' =>  $ld->remaining_leaves,
                    'back_stopped' => $lf->leave_type->backstopper_id ? 'Y' : 'N',
                    'backstopped_by' => $lf->leave_type->backstopper ? $lf->leave_type->backstopper->first_name .' '.$lf->leave_type->backstopper->first_name : ''
                ];
            }
        }
    return $all_leaves;

}


}
