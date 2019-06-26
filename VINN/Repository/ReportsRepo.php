<?php
/**
 * Created by PhpStorm.
 * User: vinnyvinny
 * Date: 1/31/19
 * Time: 12:01 PM
 */

namespace Vinn\Repository;


use App\Absence;
use App\Award;
use App\BankAccount;
use App\Department;
use App\Event;
use App\Leave;

class ReportsRepo
{
static function init(){
    return new self();
}

    public function getAbsences($startDate,$endDate)
    {
        $absences = Absence::whereHas('user')->whereBetween('created_at', [$startDate, $endDate])->get();

        $absences_details = $absences->map(function ($absence){
           return [
               'Name' => $absence->user->first_name.' '.$absence->user->last_name,
               'Date' => $absence->date,
               'Reason' => $absence->reason

           ];
        });
        return collect($absences_details);

}

    public function getDepartments()
    {
        $departments = Department::get();

        $department_details = $departments->map(function($department){
           return [
               'department' => $department->department,
               'Created' => $department->created_at
           ];
        });

        return collect($department_details);
}

    public function getAwards($startDate,$endDate)
    {
        $awards = Award::whereBetween('created_at', [$startDate, $endDate])->get();

        $awards_details= $awards->map(function ($award){
           //dd($awala)
           return [
               'Employee Name' => $award->user ? $award->user->first_name .' '.$award->user->last_name:'',
               'Award Name' => $award->award_name,
               'Gift Item' => $award->gift_item,
               'Cash Price' => $award->cash_price,
               'Date' => $award->created_at
           ];
        });

        return collect($awards_details);

 }

    public function getBankAccounts()
    {
        $bankAccount = BankAccount::get();
        $account_details = $bankAccount->map(function ($bank){
            return [
              'Employee Name' =>$bank->user?  $bank->user->first_name.' '.$bank->user->last_name :'',
              'Account Name' => $bank->account_name,
              'Account Number' => $bank->account_number,
              'Bank Name' => $bank->bank_name,
              'Branch Name' => $bank->branch_name
            ];
          });
     return collect($account_details);
    }

    public function getEmployess($employees)
    {
        $employee_details = $employees->map(function ($employee){
           return [
               'First Name' => $employee->first_name,
               'Last Name' => $employee->last_name,
               'Email' => $employee->email,
               'Cellphone' => $employee->cellphone
               ];
        });

        return collect($employee_details);
    }

    public function getEvents($startDate,$endDate)
    {
        $events = Event::whereBetween('created_at', [$startDate, $endDate])->get();

        $events_details = $events->map(function ($event) {
           return [
               'Event Name' => $event->event_name,
               'Description' => $event->description,
               'Start Date' => $event->date_start,
               'End Date' => $event->date_end
           ];
        });

        return collect($events_details);
    }

    public function getLeaves($startDate,$endDate)
    {
        $leaves = Leave::whereBetween('created_at', [$startDate, $endDate])->get();

        $leave_details = $leaves->map(function ($leave){
           return [
               'Staff' => $leave->user->first_name .' '.$leave->user->last_name,
               'Leave Type' => $leave->leave_type->leave_type,
               'Start Date' => $leave->date_from,
               'End Date' => $leave->date_to,
               'Applied On' => $leave->applied_on,
               'Reason' => $leave->reason,
               'status' => $leave->status==1 ? 'Approved' : ($leave->status==2 ? 'Pending Approval' : 'Rejected')
           ];
        });

        return collect($leave_details);
    }



}
