<?php

namespace App\Http\Controllers;

use App\Mail\ApproveTravel;
use App\Mail\RejectTravel;
use Carbon\Carbon;
use App\Hotel;
use App\Mail\TravelsHandler;
use App\Project;
use App\TravelMode;
use App\TravelPlan;
use App\User;
use Session;
use Mail;
use Auth;
use Illuminate\Http\Request;

class TravelPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $travel ='';
     if (Auth::user()->role->layout==1){
         $travel=TravelPlan::all();
     }
     else{
         $travel=TravelPlan::where('user_id',Auth::id())->get();
     }


      return view('travels.index')->with('travels',$travel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travels.create')->with('users',User::all())->with('projects',Project::all())->with('modes',TravelMode::all())->with('hotels',Hotel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $routes=[];
        $ccomodation =[];
        $room_price=0;
        $total =0;
        foreach ($request->get('addmore') as $r){

            $total+=$r['fare'];
            $routes[] = [
                'place' => $r['place'],
                'from' => date('Y-m-d',strtotime($r['from'])),
                'to' => date('Y-m-d',strtotime($r['to'])),
                'fare' => $r['fare'],
                'mode' => $r['mode']
            ];
        }
        if ($request->get('accomodate')){

            $rooms = Hotel::find($request->get('hotel'))->room_types;
            foreach (json_decode($rooms) as $room){
                if ($room->name == $request->get('room')){
                    $room_price +=$room->rate;
                    $total+=$room->rate;
                }
            }
            $ccomodation[] = [
                'hotel' => Hotel::find($request->get('hotel'))->name,
                'room' => $request->get('room'),
                'price' => $room_price
            ];
        }
TravelPlan::create([
    'user_id' => $request->get('user_id'),
    'start_date' => date('Y-m-d',strtotime($request->get('start_date'))),
    'end_date' => date('Y-m-d',strtotime($request->get('end_date'))),
    'project_id' => $request->get('project_id'),
    'total_price' => $total,
    'accomodation' => json_encode($ccomodation),
    'routes' => json_encode($routes),
    'status' => TravelPlan::STATUS_PENDING

]);

        Mail::to('pj@wizag.biz')->send(new ApproveTravel([
            'url' => url('/travels'),
            'user' => User::find($request->get('user_id'))
        ]));

   Session::flash('success','You successfully created travel plan.');
   return redirect('travels');
 }

    public function getModes()
    {
        $modes = TravelMode::all();

        return response()->json($modes);
    }

    public function approveTravel($id)
    {

     $user = TravelPlan::find($id);
     Mail::to($user->user->email)
         ->cc(Auth::user()->email)
         ->send(new TravelsHandler([
             'url' => url('/travels'),
             'username' => $user->user->first_name.' '.$user->user->last_name
         ]));
  $user->update(['status' => TravelPlan::STATUS_APPROVED]);
     Session::flash('success','Travel Plan successfully approved.');
     return redirect('travels');
    }
    public function rejectTravel($id)
    {
        $user = TravelPlan::find($id);

        Mail::to($user->user->email)
            ->cc(Auth::user()->email)->send(new RejectTravel([
                'url' => url('/travels'),
                'username' => $user->user->first_name.' '.$user->user->last_name
            ]));
        $user->update(['status' => TravelPlan::STATUS_REJECTED]);
        Session::flash('success','Travel Plan successfully rejected.');
        return redirect('travels');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('travels.show')->with('travel',TravelPlan::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
