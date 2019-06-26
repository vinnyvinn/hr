<?php

namespace App\Http\Controllers;

use App\TravelMode;
use Illuminate\Http\Request;

use App\Http\Requests;

class TravelModeController extends Controller
{
    protected $mode;

    /**
     * TravelModeController constructor.
     * @param $mode
     */
    public function __construct(TravelMode $mode)
    {
        $this->mode = $mode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('travel-mode.index')
            ->withModes($this->mode->paginate(30));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travel-mode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TravelModeRequest $request)
    {
        $this->mode->create($request->all());
        return redirect()->route('travel-mode.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('travel-mode.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('travel-mode.edit')
            ->withMode($this->mode->findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TravelModeRequest $request, $id)
    {
        $this->mode->findorfail($id)->update($request->all());
        return redirect()->route('travel-mode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mode->findorfail($id)->delete();
        return redirect()->route('travel-mode.index');
    }
}
