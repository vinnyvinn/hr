<?php

namespace App\Http\Controllers;

use App\Role;
use App\TravelPerdiem;
use App\TravelRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TravelExpensesController extends Controller
{
    protected $travelrequest;
    protected $user;
    protected $travelperdeim;

    /**
     * TravelExpensesController constructor.
     * @param $travelrequest
     * @param $user
     * @param $travelperdeim
     */
    public function __construct(Role $role,User $user,TravelRequest $travelRequest,TravelPerdiem $travelperdeim)
    {
        $this->travelrequest = $travelRequest;
        $this->user = $user;
        $this->travelperdeim = $travelperdeim;
    }

    public function index()
    {
        $all_request = $this->travelrequest->all();

        $users = $this->user;

        $travelP = $this->travelperdeim;

        $data = $all_request->map(function ($value) use($users,$travelP)
        {
            if ($value->status == TravelRequest::APRROVED) {
                $user_details = $users->findorfail($value->user_id);
                $travelP_details = $travelP->with('departments', 'travelmode')
                    ->findorfail($value->travel_perdiem_id);
                return [
                    'id' => $value->id,
                    'user_id' => $user_details->id,
                    'first_name' => $user_details->first_name,
                    'last_name' => $user_details->last_name,
                    'employee_id' => $user_details->employee_id,
                    'travel_mode' => $travelP_details->travelmode->name,
                    'department' => $travelP_details->departments->department,
                    'fare' => $travelP_details->fare,
                    'status' => $value->status,
                    'start_date' => $value->start_date,
                    'applied_on' => $value->applied_on,
                    'end_date' => $value->end_date,
                    'reason' => $value->reason
                ];
            }
        })->reject(null);

        return view('travel-requests.expenses')
            ->withExpenses($data)
            ->withTotal($data->sum('fare'));
    }
}
