<?php

namespace App\Http\Controllers;

use App\AppraisalTemplate;
use App\QuestionType;
use Illuminate\Http\Request;
use Session;
class AppraisalTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appraisal_master.templates.index')->with('templates',AppraisalTemplate::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appraisal_master.templates.create')->with('question_types',QuestionType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questions =[];
        foreach ($request->get('questions') as $q){
            $questions[] =[
                'keyVal' =>$q,
                'question' => QuestionType::find($q)->name,
                'type' =>QuestionType::find($q)->type_value

            ];
        }
        AppraisalTemplate::create([
            'name' => $request->get('name'),
            'questions' => json_encode($questions)
        ]);

        Session::flash('success','Template created successfully.');
        return redirect('template-app');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('appraisal_master.templates.show')->with('template',AppraisalTemplate::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('appraisal_master.templates.edit')->with('template',AppraisalTemplate::find($id))->with('questions',QuestionType::all());
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
        $questions =[];
        foreach ($request->get('questions') as $q){
            $questions[] =[
                'keyVal' =>$q,
                'question' => QuestionType::find($q)->name,
                'type' =>QuestionType::find($q)->type_value

            ];
        }
        AppraisalTemplate::find($id)->update([
            'name' => $request->get('name'),
            'questions' => json_encode($questions)
        ]);

        Session::flash('success','Template update successfully.');
        return redirect('template-app');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AppraisalTemplate::destroy($id);
        Session::flash('success','Template was successfully deleted');
        return redirect()->back();
    }
}
