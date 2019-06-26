<?php

namespace App\Http\Controllers;

use App\CompanyOffence;
use App\Http\Requests\OffencesRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyOffenceController extends Controller
{
    protected $offence;

    /**
     * CompanyOffenceController constructor.
     * @param $offence
     */
    public function __construct(CompanyOffence $offence)
    {
        $this->offence = $offence;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('offences.index')
            ->withOffences($this->offence->paginate(30));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OffencesRequest $request)
    {
        $this->offence->create($request->all());
        return redirect()->route('offences.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('offences.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('offences.edit')
            ->withOffence($this->offence->findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OffencesRequest $request, $id)
    {
        $this->offence->findorfail($id)->update($request->all());
        return redirect()->route('offences.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->offence->findorfail($id)->delete();
        return redirect()->route('offences.index');
    }
}
