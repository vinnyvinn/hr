<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppraisalQuestionare;
use App\Department;
use App\DesignationItem;
use App\QuestionType;
use App\AppraisalQuestion;
use App\Http\Requests;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('appraisal.questions.question-types.edit')->with('question',QuestionType::find($id));

    }

    public function editAppr($id)
    {

         return view('appraisal.questions.edit')->with('question_types',QuestionType::all())->with('appr',AppraisalQuestion::find($id));
    }

    public function updateAppr($id)
    {

        AppraisalQuestion::find(request()->get('id'))->update(['question' =>request()->get('question'),'question_type_id' => request()->get('question_type_id')]);
    return redirect('/appraisal-questions');
    }

    public function editTemp($id)
    {

        $questionare = AppraisalQuestionare::find($id);
        $questions = AppraisalQuestion::all();
        $departments = Department::all();
        $designations = DesignationItem::all();
       return view('appraisal.questionare-template.edit',compact('questions','departments','designations','questionare'));
    }

    public function updateTemp($id)
    {
        AppraisalQuestionare::find($id)->update(['name'=>request()->get('name'),'questions'=>json_encode(request()->get('questions')),
        'department_id' => request()->get('department_id'),'designation_id'=>request()->get('designation_id')]);
      return redirect('/appraisal-template');
    }

    public function removeTemp($id)
    {
        AppraisalQuestionare::find($id)->delete();
        return redirect()->back();
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
        $quiz = QuestionType::find($id);
        $quiz->name = $request->get('name');
        $quiz->type_value = $request->get('type_value');
        $quiz->save();

        return redirect('/question-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuestionType::find($id)->delete();
        return redirect()->back();
    }

    public function remove($id){

        AppraisalQuestion::find($id)->delete();
        return redirect()->back();
    }
}
