<?php

namespace App\Http\Controllers;

use App\ContractTemplate;
use App\Http\Requests\ContractTemplateRequest;
use http\Env\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ContractTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contracts.templates.index')->with('templates',ContractTemplate::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contracts.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $template = ContractTemplate::create($request->all());
        Session::flash('success','Template Successfully created');
        return response()->json($template);
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
        return view('contracts.templates.edit')->with('contract',ContractTemplate::find($id));
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

        $template = ContractTemplate::findOrFail($request->id)->update([
            'contract_parameter' => $request->get('contract_parameter'),
            'name' => $request->get('name'),
            'gross_amount' => $request->get('gross_amount'),
            'payment' => $request->get('payment'),
            'payment_frequency' => $request->get('payment_frequency'),
            'duration' => $request->get('duration'),
            'start_date' => $request->get('start_date'),
            'contract_type' => $request->get('contract_type')
        ]);
        Session::flash('success','Template Successfully updated');
        return response()->json($template);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContractTemplate::destroy($id);
        return redirect()->back();
    }
}
