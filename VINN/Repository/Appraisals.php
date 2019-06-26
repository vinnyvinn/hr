<?php


namespace Vinn\Repository;


use App\AppraisalMaster;
use App\AppraisalProcess;
use App\AppraisalQuestion;
use App\QuestionType;
use App\User;
use Auth;

class Appraisals
{

    static function init(){
        return new self();
    }

    function getAllAppraisals(){

        $templates=AppraisalMaster::get()->map(function ($template){
            $tmp = AppraisalProcess::where('user_id',Auth::id())->where('template_id',$template->template_id);

            return [
                'id' => $template->id,
                'template' => $template->template->name,
                'Department' => $template->department ? $template->department->department:'',
                'Designation' => $template->designation_item ? $template->designation_item->designation_item:'',
                'status' => $tmp->first() !=null ? $tmp->first()->status : 'pending',
                'employee' => json_decode($template->user_id)

            ];
        });
        foreach ($templates as $temp){
          if (in_array(Auth::id(),$temp['employee']))
              $templates_found[]=$temp;
        }

       return collect($templates_found);
    }

    public function allAppraisals()
    {
            $templates=AppraisalProcess::get()->map(function ($appraisal){
                 return [
                'id' => $appraisal->id,
                'template' => $appraisal->template->name,
                'Department' => User::find($appraisal->user_id)->department->department,
                'Designation' => User::find($appraisal->user_id)->designation_item->designation_item,
                'status' => $appraisal->status,
                'employee' => User::find($appraisal->user_id)->first_name.' '.User::find($appraisal->user_id)->last_name
            ];
        });

        return collect($templates);
}

    function getQuestionTypes($id){
        $appraisals = AppraisalMaster::find($id);
        $questions = QuestionType::get();
        $all_quiz = [];
        $q_ids=[];

        foreach (json_decode($appraisals->question_id) as $q){
            array_push($q_ids,$q);
        }

        foreach ($questions as $quiz){
            if(in_array($quiz->id,$q_ids)){
                $all_quiz[]= $quiz;
            }
        }
      return $all_quiz;
    }

    function processQuiz($id){
   $process = AppraisalProcess::find($id);
   $data = [];
   $test = json_decode($process->evaluator_response);
   $test2 = json_decode($process->answers);

  // return collect($test);
   foreach (collect($test) as $key => $value) {
       foreach (collect($test2) as $k => $val) {
           if($key ==$k){
               $data[] = [
                   'question' => $value->question,
                   'answer' => $value->answer,
                   'question_type' => $value->question_type,
                   'response' => $value->response
                   ];
           }

       }
   }
return $data;

   foreach (json_decode($process->evaluator_response) as $key => $p) {
       foreach (json_decode($process->answers) as $k => $q) {
         $data [] =$key;
           //if ($p == $k) {
             //  dd('walla');
//               $data[] = [
//                   'question' => $p->question,
//                   'answer' => $p->answer,
//                   'question_type' => $p->question_type,
//                   'ques' => $q->question
//
//               ];
//           }
       }
   }

  //return $data;
    }


}
