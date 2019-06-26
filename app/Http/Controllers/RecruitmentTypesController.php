<?php

namespace App\Http\Controllers;

use App\RecruitmentType;
use Illuminate\Http\Request;
use App\Http\Requests\RecruitmentTypeRequest;


class RecruitmentTypesController extends Controller
{
    protected $recruitmenttype;

    /**
     * RecruitmentTypesController constructor.
     * @param $recruitmenttype
     */
    public function __construct(RecruitmentType $recruitmenttype)
    {
        $this->recruitmenttype = $recruitmenttype;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recruitmenttypes.index')
            ->withRecruitmenttypes($this->recruitmenttype->paginate(30)
                );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recruitmenttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecruitmentTypeRequest $request)
    {
        $this->recruitmenttype->create($request->all());
        return redirect()->route('recruitment-type.index');
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
        return view('recruitmenttypes.edit')
            ->withType($this->recruitmenttype->findorfail($id));
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
        $this->recruitmenttype->findorfail($id)->update($request->all());
        return redirect()->route('recruitment-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->recruitmenttype->findorfail($id)->delete();
        return redirect()->route('recruitment-type.index');
    }
}
