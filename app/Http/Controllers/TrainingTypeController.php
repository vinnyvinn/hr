<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingTypesRequest;
use App\TrainingType;
use Illuminate\Http\Request;

use App\Http\Requests;

class TrainingTypeController extends Controller
{
    protected $trainingtype;

    /**
     * trainingtypesController constructor.
     * @param $trainingtype
     */
    public function __construct(TrainingType $trainingtype)
    {
        $this->trainingtype = $trainingtype;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainingtypes.index')
            ->withTrainingtypes($this->trainingtype->paginate(30)
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainingtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingtypesRequest $request)
    {
        $this->trainingtype->create($request->all());
        return redirect()->route('training-types.index');
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
        return view('trainingtypes.edit')
            ->withType($this->trainingtype->findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrainingTypesRequest $request, $id)
    {
        $this->trainingtype->findorfail($id)->update($request->all());
        return redirect()->route('training-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->trainingtype->findorfail($id)->delete();
        return redirect()->route('training-types.index');
    }
}
