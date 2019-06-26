<?php

namespace App\Http\Controllers;

use App\LeaveBalance;
use App\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Session;

class LeaveBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leaves.opening_balance_index')->with('staff',LeaveBalance::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('leaves.opening_balance')->with('staff',User::all())->with('leave_types',LeaveType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year_now = new Carbon(Carbon::now());
        LeaveBalance::create([
            'user_id' => request()->get('user_id'),
            'leave_type_id' => request()->get('leave_type_id'),
            'opening_balance' => request()->get('opening_balance'),
            'year' => $year_now->year
        ]);
        Session::flash('success', 'Leave balance has been saved.');
        return redirect()->back();
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
        return view('leaves.edit_balance')->with('balance',LeaveBalance::findOrFail($id))->with('leave_types',LeaveType::all());
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
        
        LeaveBalance::find($id)->update([
            'user_id' => request()->get('user_id'),
            'leave_type_id' => request()->get('leave_type_id'),
            'opening_balance' => request()->get('opening_balance')
        ]);
        Session::flash('success', 'Leave balance has been updated.');
        return redirect('/leave-balance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LeaveBalance::destroy($id);
        Session::flash('success', 'Leave balance has been deleted.');
        return redirect('/leave-balance');
    }
}
