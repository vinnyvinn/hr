<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelRequestRequest;
use App\TravelPerdiem;
use App\TravelRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function processTravelRequest($id)
    {

//        if(Auth::user()->role->role_permission('process_leave')){
//            if (Auth::user()->role->role_permission('process_leave')->level == 'team')
//            {
                $travel_request = TravelRequest::findorfail($id);
                $user = User::findorfail($travel_request->user_id);
                $travel_perdiem = TravelPerdiem::with('departments','travelmode')
                    ->findorfail($travel_request->travel_perdiem_id);
                $data = collect([
                    'id'=>$travel_request->id,
                    'first_name'=>$user->first_name,
                    'last_name'=>$user->last_name,
                    'department'=>$travel_perdiem->departments->department,
                    'travel_mode'=>$travel_perdiem->travelmode->name,
                    'date_from'=>$travel_request->start_date,
                    'date_to'=>$travel_request->end_date,
                    'date_applied'=>$travel_request->applied_on,
                    'reason'=>$travel_request->reason,
                    'fare'=>$travel_perdiem->fare,
                ]);
//            }
//            if(Auth::user()->role->role_permission('process_leave')->level == 'team') {
//
//            }}
               return view('travel-requests.approved')
                   ->withData($data);
    }

    public function updateTravelRequest(Request $request,$id)
    {
        TravelRequest::findorfail($id)->update(['status'=>$request->status]);
        return redirect('/travel-request')->withSuccess('Successfully editted');
    }
}
