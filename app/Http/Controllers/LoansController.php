<?php

namespace App\Http\Controllers;

use Auth;
use App\Loan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if(Auth::user()->role->layout ==1){

            $loans = Loan::all();

        }
        else{
            $loans = Auth::user()->loans;
        }
        return view('loans.index')->with('loans',$loans);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('loans.create')->with('users',User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           Loan::create([
           'user_id' => $request->get('user_id'),
            'type' => $request->get('type'),
            'amount' => $request->get('loan_amount') ?: $request->get('advance_amount'),
            'monthly_repayment' => $request->get('monthly_repayment'),
            'installment_months' => $request->get('installment_months'),
            'purpose' => $request->get('purpose'),
            'date' => $request->get('repay_date') ?: $request->get('rq_date'),
            'interest_rate' => $request->get('interest_rate')
        ]);

        Session::flash('success',$request->get('type') .' was successfully created');
        return response()->json($request->all());
    }

    public function loanAmount($id)
    {
      $loan_amount = Loan::find($id);
      $username = $loan_amount->user->first_name .' '.$loan_amount->last_name;
      return response()->json(['amount'=>$loan_amount->amount,'username' =>$username]);
    }

    public function updateAmount($id)
    {
    $loan = Loan::find($id)->update([
        'approved_amount' => request()->get('amount'),
        'approved_date' => Carbon::now(),
        'status' => 1
    ]);
    Session::flash('success','You successfully approved');
    return response()->json($loan);
    }
    public function rejectLoan($id)
    {
        $loan = Loan::find($id)->update([
            'reject_reason' => request()->get('message'),
            'status' => 2
        ]);
        Session::flash('success','You successfully rejected');
        return response()->json($loan);
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
