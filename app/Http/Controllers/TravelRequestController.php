<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelRequestRequest;
use App\Permission;
use App\Role;
use App\TravelPerdiem;
use App\TravelRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TravelRequestController extends Controller
{
    protected $role;
    protected $user;
    protected $travelperdeim;
    protected $travelrequest;

    /**
     * TravelRequestController constructor.
     * @param $role
     * @param $user
     */
    public function __construct(Role $role,User $user,TravelRequest $travelRequest,TravelPerdiem $travelperdeim)
    {
        $this->role = $role;
        $this->user = $user;
        $this->travelrequest = $travelRequest;
        $this->travelperdeim = $travelperdeim;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_request = $this->travelrequest->all();

        $users = $this->user;

        $travelP = $this->travelperdeim;

        $data = $all_request->map(function ($value) use($users,$travelP)
        {
            $user_details = $users->findorfail($value->user_id);
            $travelP_details = $travelP->with('departments','travelmode')
                ->findorfail($value->travel_perdiem_id);
            return [
                'id'=>$value->id,
                'user_id'=>$user_details->id,
                'first_name'=>$user_details->first_name,
                'last_name'=>$user_details->last_name,
                'employee_id'=>$user_details->employee_id,
                'travel_mode'=>$travelP_details->travelmode->name,
                'department'=>$travelP_details->departments->department,
                'fare'=>$travelP_details->fare,
                'status'=>$value->status,
                'start_date'=>$value->start_date,
                'applied_on'=>$value->applied_on,
                'end_date'=>$value->end_date,
                'reason'=>$value->reason
            ];
        });


        return view('travel-requests.index')
            ->withTravelrequests($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelRequestRequest $request)
    {
        $users = $this->user->with('role')->get();
        //for notification.
        foreach ($users as $user)
        {
            if($this->role->findorfail($user->role_id)->role_permission('approve_travel_request'))
            {

            }

        }
        $data =
            [
                'user_id' =>Auth::user()->id,
                'travel_perdiem_id' => $request->travel_perdiem_id,
                'reason'=>$request->reason,
                'start_date'=>Carbon::parse($request->start_date),
                'applied_on' => Carbon::parse($request->applied_on),
                'end_date'=>Carbon::parse($request->end_date),
                'status'=>TravelRequest::PENDING
            ];

        $this->travelrequest->create($data);
        return redirect()->route('travel-request.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requestDetails = $this->travelrequest->findorfail($id);
        $travel_perdiem = $this->travelperdeim->where('department_id',User::findorfail($requestDetails->user_id)
        ->department_id)->get();
        return view('travel-requests.edit')
            ->withData($requestDetails)
            ->withTravelperdiems($travel_perdiem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelRequestRequest $request, $id)
    {
        $data =
            [
                'travel_perdiem_id' => $request->travel_perdiem_id,
                'start_date'=>Carbon::parse($request->start_date)->toDateString(),
                'applied_on'=>Carbon::parse($request->applied_on)->toDateString(),
                'end_date'=>Carbon::parse($request->end_date)->toDateString(),
                'reason'=>$request->reason
            ];
        $this->travelrequest->findorfail($id)->update($data);
        return redirect('travel-request')->withSuccess('Request updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->travelrequest->findorfail($id)->delete();
        return redirect('/travel-request')->withSuccess('Deleted successfully');
    }
}
