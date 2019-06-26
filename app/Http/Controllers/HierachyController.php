<?php

namespace App\Http\Controllers;

use App\Hierachy;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class HierachyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hierachies.index')->with('details',Hierachy::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hierachies.create')->with('users',User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $hierachy = Hierachy::create([
          'user_id' => $request->get('staff_id'),
          'manager_id' => $request->get('manager_id'),
          'supervisor_id' => $request->get('supervisor_id')
      ]);
      if ($request->has('user_id')) {
         $hierachy->users()->attach($request->get('user_id'));
      }
      Session::flash('success','You successfully created a hierachy');
      return redirect('hierachy');

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
        return view('hierachies.edit')->with('detail',Hierachy::find($id))->with('users',User::all());
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
        $hierachy = Hierachy::find($id)->update([
            'user_id' => $request->get('staff_id'),
            'manager_id' => $request->get('manager_id'),
            'supervisor_id' => $request->get('supervisor_id')
        ]);
        if ($request->has('user_id')) {
            $hierachy_f = Hierachy::find($id);
            $hierachy_f->users()->sync($request->get('user_id'));
        }
        Session::flash('success','You successfully updated a hierachy');
        return redirect('hierachy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hierachy::find($id)->users()->detach();
        Hierachy::destroy($id);
        Session::flash('success','Item successfully removed');
        return redirect()->back();
    }
}
