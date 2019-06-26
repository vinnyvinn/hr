<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;
use Session;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hotels.index')->with('hotels',Hotel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rooms =[];
        foreach ($request->get('addmore') as $room){

            $rooms[] =[
              'name' =>$room['room_name'],
                'rate' => $room['rate'],
                'currency' => $room['currency']
            ];
        }
        Hotel::create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'country' => $request->get('country'),
            'city' => $request->get('city'),
            'room_types' => json_encode($rooms)
        ]);

        Session::flash('success','Hotel Successfully Added');
        return redirect('hotels');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('hotels.show')->with('rooms',Hotel::find($id));
    }

    public function getRooms($id)
    {
       return response()->json(json_decode(Hotel::find($id)->room_types));
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
