<?php

namespace App\Http\Controllers;

use App\User;
use App\Vehicle;
use Illuminate\Http\Request;

use App\Http\Requests;

class VehicleController extends Controller
{
    protected $user;
    protected $vehicle_details;

    /**
     * VehicleController constructor.
     * @param $user
     * @param $vehicle_details
     */
    public function __construct(User $user,Vehicle $vehicle_details)
    {
        $this->user = $user;
        $this->vehicle_details = $vehicle_details;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vehicle-details.index')
            ->withVehicles($this->vehicle_details->with('user')->paginate(30));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle-details.create')
            ->withUsers($this->user->all()->sortBy('first_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\VehicleRequest $request)
    {
        $this->vehicle_details->create($request->all());
        return redirect('vehicle-details')
            ->withSuccess('Vehicle details added successfully');
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
        return view('vehicle-details.edit')
            ->withUsers($this->user->all()->sortBy('first_name'))
        ->withVehicle($this->vehicle_details->with(['user'])->findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\VehicleRequest $request, $id)
    {
        $this->vehicle_details->findorfail($id)->update($request->all());
        return redirect('vehicle-details')->withSuccess('Vehicle details update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->vehicle_details->findorfail($id)->delete();
        return redirect('vehicle-details')->withSuccess('Vehicle detail deleted successfully');
    }
}
