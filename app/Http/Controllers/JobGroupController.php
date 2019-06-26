<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobGroupsRequest;
use App\JobGroup;
use App\NationalitiesClass;
use Illuminate\Http\Request;

use App\Http\Requests;

class JobGroupController extends Controller
{
    protected $job_description;

    /**
     * JobGroupController constructor.
     * @param $job_description
     */
    public function __construct(JobGroup $job_description)
    {
        $this->job_description = $job_description;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobgroups.index')
            ->withJobgroups($this->job_description->paginate(30));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        return view('jobgroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobGroupsRequest $request)
    {
        $this->job_description->create($request->all());
        return redirect()->route('job-groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('job-groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('jobgroups.edit')
            ->withJobgroup($this->job_description->findorfail($id));
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
        $this->job_description->findorfail($id)->update($request->all());
        return redirect()->route('job-groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->job_description->findorfail($id)->delete();
        return redirect()->route('job-groups.index');
    }
}
