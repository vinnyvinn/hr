<?php

namespace App\Http\Controllers;

use App\Department;
use App\TravelMode;
use App\TravelPerdiem;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Calendar;

class TravelPerdiemController extends Controller
{
    protected $modes;
    protected $departments;
    protected $travelperdiem;

    /**
     * TravelPerdiemController constructor.
     * @param $modes
     * @param $departments
     * @param $travelperdiem
     */
    public function __construct(TravelMode $modes,Department $departments,TravelPerdiem $travelperdiem)
    {
        $this->modes = $modes;
        $this->departments = $departments;
        $this->travelperdiem = $travelperdiem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travel_perdiem = $this->travelperdiem->with('travelmode','departments')->get();
        $data = $travel_perdiem->map( function ($value, $key)

        {
            return
                [
                    'department'=>$value->departments ? $value->departments->department : '',
                    'id'=>$value->departments ? $value->departments->id : '',
                    'description' =>$value->descrition


                ];
        });

        if (Auth::user()->role->role_permission('view_leaves'))
        {
            return view('travel-perdiem.index')
                ->withDepartments($data->keyBy('id'));
        }

        return redirect('/travel-perdiem/'.Auth::user()->department_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travel-perdiem.create')
            ->withModes($this->modes->all()->sortBy('name'))
            ->withDepartments($this->departments->all()->sortBy('department'));
    }

    public function getUsers($id)
    {

        return response()->json(Department::find($id)->users);
    }

    public function moreUsers($id)
    {
        $departments = Department::where('id','!=',$id)->get();

        $users = [];
        foreach ($departments as $department){
            foreach ($department->users as $user){
                $users[] = $user;
            }
        }
     return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empl=[];
        if ($request->get('employee')){
            foreach ($request->get('employee') as $emp){
                $empl[]=$emp;
            }
        }
        $empl[] = $request->get('user_id');
        array_merge($empl,$request->get('user_id'));
        dd($empl);
        $fares = $request->fare;
        $from = $request->from_location;
        $to = $request->to_location;
        $now = Carbon::now();
        $data = [];
        foreach ($fares as $key => $value)
        {
            $data[] =
                [
                    'department_id' => $request->department_id,
                    'travel_mode_id'=>$request->travel_mode_id,
                    'description' => $request->description,
                    'from_location'=>$from[$key],
                    'to_location'=>$to[$key],
                    'fare'=>$value,
                    'created_at'=>$now,
                    'updated_at'=>$now
                ];
        }

        $this->travelperdiem->insert($data);
        return redirect('travel-perdiem')->withSuccess('Travel erdiem add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = $this->departments->findorfail($id)->department;

        $travel_pd = $this->travelperdiem->where('department_id',$id)->with('departments','travelmode')
            ->get();

        if(count($travel_pd) < 1)
        {
            abort(403);
        }

        $travel_mode = $travel_pd->first()->travelmode->name;

        $fare = [];
        foreach ($travel_pd as $key => $value)
        {
            $fare[] =
                [
                    'from'=>$value->from_location,
                    'to'=>$value->to_location,
                    'fare'=>$value->fare,
                    'id'=>$value->id
                ];
        }
        return view('travel-perdiem.show')
            ->withDepartment($department)
            ->withTravelmode($travel_mode)
            ->withFares($fare)
            ->withId($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel_pd = $this->travelperdiem->where('department_id',$id)
            ->with('departments','travelmode')
            ->get();
        return view('travel-perdiem.edit')
            ->withDepartments($this->departments->all())
            ->withPerdiems($travel_pd)
            ->withModes($this->modes->all())
            ->withId($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TravelPerdiemRequest $request, $id)
    {
        $all_perdiems = $this->travelperdiem->where('department_id',$id)->get();
        $perdiem_id = $all_perdiems->map(function ($value)
        {
            return $value->id;
        })->toArray();

        $this->travelperdiem->destroy($perdiem_id);

        $fares = $request->fare;
        $from = $request->from_location;
        $to = $request->to_location;
        $now = Carbon::now();
        $data = [];
        foreach ($fares as $key => $value)
        {
            $data[] =
                [
                    'department_id' => $request->department_id,
                    'travel_mode_id'=>$request->travel_mode_id,
                    'from_location'=>$from[$key],
                    'to_location'=>$to[$key],
                    'fare'=>$value,
                    'created_at'=>$now,
                    'updated_at'=>$now
                ];
        }

        $this->travelperdiem->insert($data);
        return redirect()->route('travel-perdiem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $all_perdiems = $this->travelperdiem->where('department_id',$id)->get();
        $perdiem_id = $all_perdiems->map(function ($value)
        {
            return $value->id;
        })->toArray();

        $this->travelperdiem->destroy($perdiem_id);

        return redirect('/travel-perdiem')->withSuccess('Deleted Successfully');
    }
}
