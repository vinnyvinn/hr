<?php

namespace App\Http\Controllers;

use App\Branch;
use App\City;
use App\Http\Requests\BranchRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use League\Flysystem\Config;

class BranchController extends Controller
{
    protected $branch;

    /**
     * BranchController constructor.
     * @param $branch
     */
    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('branches.index')
            ->withBranches($this->branch->paginate(30));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('branches.create')
            ->withCities(City::all()->sortBy('name'))->with('zones',\Config::get('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {

        $branch = $this->branch->create($request->all());
        return redirect()->route('branches.index')->withSuccess($branch->name.' has been saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('branches.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('branches.edit')
        ->withBranch($this->branch->findorfail($id))
            ->withId($id)
            ->withCities(City::all()->sortBy('name'));
    }

    public function getCities()
    {
      $zones =  \Config::get('zones.'.request()->get('zone'));
       return response()->json($zones);
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

        Branch::findorfail($id)->update($request->all());
        return redirect()->route('branches.index')
            ->withSuccess($this->branch->findorfail($id)->name.' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->branch->findorfail($id)->delete();
        return redirect()->route('branches.index')
            ->withSuccess('Branch has been deleted.');
    }
}
