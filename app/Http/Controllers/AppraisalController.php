<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AppraisalQuestion;
use App\QuestionType;
use App\Department;
use App\DesignationItem;
use App\AppraisalQuestionare;
use App\User;
use App\ActiveAppraisals;
use App\UserAppraisal;
use Mail;
use Auth;
use Session;
use Symfony\Component\Yaml\Tests\A;


class AppraisalController extends Controller
{
    /**
     * Display a listing of sthe resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //

        $questions = AppraisalQuestion::all();

        $question_types = QuestionType::all();
        //dd($question_types);
        return view ('appraisal.questions.index', compact('questions', 'question_types'));

    }
    public function index_question_type()
    {
        $question_types = QuestionType::all();
        return view ('appraisal.questions.question-types.index', compact('question_types'));
    }
    public function question_type_create(){

        return view ('appraisal.questions.question-types.create');
    }
    public function store_question_type(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $question = new QuestionType;
        $question->name = $data['name'];
        $question->type_value = $data['type_value'];
        $question->save();
        return redirect('question-types')->withSuccess('Question type has been saved.');


    }
   public function active_appraisal()
   {

        $departments = Department::all();
        $designations = DesignationItem::all();
        $questionares = AppraisalQuestionare::all();
        $active_appraisals = ActiveAppraisals::all();


        return view ('appraisal.initialize-template.index',
                compact('departments', 'designations', 'questionares', 'active_appraisals'));

   }
    public function active_appraisal_user()
    {

        $departments = Department::all();
        $designations = DesignationItem::all();
        $questionares = AppraisalQuestionare::all();
        $appraisals = ActiveAppraisals::all();

        $items_found = [];
         foreach ($appraisals as $active) {
             $ids = json_decode($active->employees_participating);
             if (in_array(Auth::id(), array_flatten($ids))) {
                 $items_found []=$active;

             }
         }
         if (count($items_found))
        return view('appraisal.initialize-template.index_user',
            compact('departments', 'designations', 'questionares', 'items_found'));

        else
            Session::flash('fail', 'Sorry,you do not have active appraisals');
        return redirect()->back();

    }

   public function activate_appraisal(){

        return view ('appraisal.initialize-template.create',[

            'questionares' => AppraisalQuestionare::all()
        ]);

   }
   public function finalize_appraisal_activation(Request $request){

        $questionare = AppraisalQuestionare::findorFail($request->questionare_id);
        $departments = Department::all();
        $designations = DesignationItem::all();
        $employees = User::where('designation_item_id', $questionare->designation_id)
                                ->where('department_id', $questionare->department_id)
                                ->get();
        return view ('appraisal.initialize-template.template', compact('departments', 'designations', 'employees', 'questionare'));



   }
   public function process_finalization(Request $request)
   {


        $activate_appraisal = new ActiveAppraisals;
        $activate_appraisal->appraisalquestionare_id = $request->questionare_id;
        $activate_appraisal->employees_participating = json_encode($request->employees);
        $activate_appraisal->status = 1;
        $activate_appraisal->save();


        foreach ($request->employees as $emp) {
            # code...
                $user = User::findOrFail($emp);
                // dd($user);
                Mail::send('emails.newappraisal', ['user' => $user], function ($m) use ($user) {
                $m->from('cloudhr@app.com', 'Your Application');

                $m->to($user->email, $user->first_name)->subject('New Appriasal Notification!');
            });

          }
     return redirect('active-appraisals')->withSuccess('you successfully initiated an appraisal');

       

   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $question_types = QuestionType::all();
        // dd($question_types);
           return view ('appraisal.questions.create', compact('question_types'));
    }
    public function create_question_type()
    {

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
        $question = new AppraisalQuestion;
        $question->question = $request->question;
        $question->question_type_id = $request->question_type_id;
        $question->save();
        Session::flash('success','Question has been saved.');
        return redirect()->back();
        //return redirect('appraisal-questions')->withSuccess('Question has been saved.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('no way');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function index_template()
    {
        $questionares = AppraisalQuestionare::all();
         $questions = AppraisalQuestion::all();
        $departments = Department::all();
        $designations = DesignationItem::all();

        return view ('appraisal.questionare-template.index', compact('questionares', 'departments', 'designations'));
    }
    public function create_template()
    {
        $questions = AppraisalQuestion::all();
        $departments = Department::all();
        $designations = DesignationItem::all();
        return view ('appraisal.questionare-template.create', compact('questions', 'departments', 'designations'));
    }
    public function store_template(Request $request)
    {


         ///   dd(json_encode($request->questions));

            $questionare = new AppraisalQuestionare;
            $questionare->name = $request->name;
            $questionare->questions = json_encode($request->questions);
            $questionare->department_id = $request->department_id;
            $questionare->designation_id = $request->designation_id;
            $questionare->save();

            return redirect('appraisal-template')->withSuccess('Questionare created successfully');
    }
    public function perform_appraisal($id)
    {   
        $data = ActiveAppraisals::findOrFail($id);

                    $id = $data->id;
                    $questionare = AppraisalQuestionare::findOrFail($data->appraisalquestionare_id);
                    $questions  = AppraisalQuestion::findMany(json_decode($questionare->questions));
                      return view ('appraisal.user-appraisal.appraisal', compact('questions', 'data', 'id'));
                   

                 

    }
     public function process_appraisal(Request $request)
    { 
            $data = $request->all();
      
                $aray =  (array)$data;
               unset($data['active_id'], $data['_token'], $data['save']);
               dd($data);
                $userappraisals = new UserAppraisal;
                $userappraisals->user_id = Auth::user()->id;
                $userappraisals->activeappraisal_id =  $data->active_id;

    }
}
