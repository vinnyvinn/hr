<?php

namespace App\Http\Controllers;

use App\CancelContract;
use App\Contract;
use App\ContractTemplate;
use App\Reason;
use App\RenewContract;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contracts.index')->with('contracts', Contract::where('status', 1)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contracts.create')->with('users', User::all())->with('templates', ContractTemplate::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $contract = Contract::create([
            'expiry_date' => $request->get('expiry_date'),
            'template_id' => $request->get('template_id')
        ]);
        $contract->users()->attach($request->get('user_id'));
        Session::flash('success', 'Contact successfully created');
        return redirect('/contracts');
    }

    public function teminateContract()
    {

        return view('contracts.cancel_contract')->with('users', User::all())->with('reasons',Reason::all());
    }

    public function initTerminate()
    {

        $contact = DB::table('contract_user')->whereIn('user_id',request()->get('user_id'))->first();
        if ($contact==null){
            Session::flash('fail','Sorry,the contract was not found');
            return redirect()->back();
        }
        $contact_found = Contract::find($contact->contract_id);
        $cancel_contact = CancelContract::create([
            'reason' => request()->get('reason'),
            'termination_date' => request()->get('termination_date')
        ]);
        $cancel_contact->users()->attach(request()->get('user_id'));
        $contact_found->users()->detach(request()->get('user_id'));
        Session::flash('success', count(request()->get('user_id')).' Contract(s) successfully cancelled ');
        return redirect('/contracts');
    }

    public function renewContract()
    {
      return view('contracts.renew_contract')->with('users',User::all());
    }

    public function updateRenewal()
    {
        $contact = DB::table('contract_user')->whereIn('user_id',request()->get('user_id'))->first();
        if ($contact==null){
            Session::flash('fail','Sorry,the contract was not found');
            return redirect()->back();
        }
        $renew_contract =  RenewContract::create([
           'renewal_date' => request()->get('renewal_date')
        ]);
        $contract_found = Contract::find($contact->contract_id);
        $renew_contract->users()->attach(request()->get('user_id'));
        $contract_found->users()->sync(request()->get('user_id'));

        Session::flash('success', count(request()->get('user_id')).' Contract(s) successfully renewed');
        return redirect('/contracts');
    }

    public function Reason()
    {
        Reason::create(request()->all());
        return redirect()->back();
}
    public function cancelledContracts()
    {
        return view('contracts.cancelled_contracts')->with('contracts',CancelContract::all());
    }

    public function renewedContracts()
    {
        return view('contracts.renewed_contracts')->with('contracts',RenewContract::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('contracts.edit')->with('contract', Contract::find($id))->with('users', User::all())->with('templates',ContractTemplate::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Contract::find($id)->update(['expiry_date' => $request->get('expiry_date'),
            'template_id' => $request->get('template_id')]);
        $contract = Contract::find($id);
        $contract->users()->sync($request->get('user_id'));

        Session::flash('success', 'Successfully updated contract');
        return redirect('/contracts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
