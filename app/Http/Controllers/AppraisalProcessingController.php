<?php

namespace App\Http\Controllers;

use App\AppraisalMaster;
use App\AppraisalProcess;
use App\AppraisalQuestion;
use App\QuestionType;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Vinn\Repository\Appraisals;
use Session;

class AppraisalProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appraisal_master.process.index')->with('appraisals',Appraisals::init()->allAppraisals());
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $result = [];
        $i=1;
        if ($request->has('q1')) {
            foreach ($request->get('q1') as $k => $p) {
                foreach ($request->get('qe1') as $key => $q) {
                    if ($k == $key) {
                        $result[] = [
                            'keyVal' => $i++,
                            'question' => $q,
                            'answer' => $p,
                            'question_type' => QuestionType::NUMERIC
                        ];
                    }
                }
            }
        }
        if ($request->has('q2')) {
            foreach ($request->get('q2') as $k => $p) {
                foreach ($request->get('qe2') as $key => $q) {
                    if ($k == $key) {
                        $result[] = [
                            'keyVal' => $i++,
                            'question' => $q,
                            'answer' => $p,
                            'question_type' => QuestionType::TEXT
                        ];
                    }
                }
            }
        }
        if ($request->has('q3')) {
            foreach ($request->get('q3') as $k => $p) {
                foreach ($request->get('qe3') as $key => $q) {
                    if ($k == $key) {
                        $result[] = [
                            'keyVal' => $i++,
                            'question' => $q,
                            'answer' => $p,
                            'question_type' => QuestionType::STARS
                        ];
                    }
                }
            }
        }
        if ($request->has('optradio')) {
               foreach (array_values($request->get('optradio')) as $k => $p) {
                   foreach (array_values($request->get('q4')) as $key => $q) {
                    if ($k == $key) {
                        $result[] = [
                            'keyVal' => $i++,
                            'question' => $q,
                            'answer' => $p,
                            'question_type' => QuestionType::TRUE_FALSE
                        ];
                    }
                }
            }
        }

        $appr = AppraisalProcess::create([
            'user_id' => Auth::id(),
            'template_id' => $request->get('id'),
            'answers' => json_encode($result),
            'issue_date' => $request->get('issue_date'),

        ]);

        if ($request->get('submit') == 'Cancel'){
            $appr->update(['status'=>AppraisalProcess::STATUS_CANCELLED]);
            Session::flash('success', 'Appraisal successfully Cancelled');
            return redirect('/appraisal-master');
        }
        elseif ($request->get('submit') == 'Save'){
            $appr->update(['status'=>AppraisalProcess::STATUS_WIP]);
        }
        else{
            $appr->update(['status'=>AppraisalMaster::STATUS_WIP]);
        }



        Session::flash('success', 'Appraisal successfully initiated');
        return redirect('/appraisal-master');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

//      if (AppraisalProcess::where('template_id',AppraisalMaster::find($id)->template_id)->first()){
//
//         return view('appraisal_master.process.edit_index')->with('process',AppraisalProcess::where('template_id',AppraisalMaster::find($id)->template_id)->first());
//      }

        return view('appraisal_master.process.show')->with('types', Appraisals::init()->getQuestionTypes($id))
            ->with('appraisal', AppraisalMaster::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $process = AppraisalProcess::find($id);
        return view('appraisal_master.process.edit')->with('process',$process);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = [];
        $i=1;
        if ($request->has('res1')) {
            foreach ($request->get('res1') as $k => $r) {
                foreach ($request->get('qe1') as $key => $q) {
                    foreach ($request->get('q1') as $ky => $p) {
                        if ($k == $key && $k == $ky) {
                            $result[] = [
                                'keyVal' => $i++,
                                'question' => $q,
                                'answer' => $p,
                                'question_type' => 'numeric',
                                'rating' => 5,
                                'response' => $r
                            ];
                        }
                    }
                }
            }
        }
        if ($request->has('res2')) {
            foreach ($request->get('res2') as $k => $r) {
                foreach ($request->get('qe2') as $key => $q) {
                    foreach ($request->get('q2') as $ky => $p) {
                        if ($k == $key && $k==$ky) {
                            $result[] = [
                                'keyVal' => $i++,
                                'question' => $q,
                                'answer' => $p,
                                'question_type' => 'text',
                                'rating' => 5,
                                'response' => $r
                            ];
                        }
                    }
                }
            }
        }
        if ($request->has('res3')) {
            foreach ($request->get('res3') as $k => $r) {
                foreach ($request->get('qe3') as $key => $q) {
                    foreach ($request->get('q3') as $ky => $p) {
                        if ($k == $key && $k==$ky) {
                            $result[] = [
                                'keyVal' => $i++,
                                'question' => $q,
                                'answer' => $p,
                                'question_type' => 'stars',
                                'rating' => 5,
                                'response' => $r
                            ];
                        }
                    }
                }
            }
        }

        if ($request->has('res4')) {
            foreach ($request->get('res4') as $k => $r) {
                foreach (array_values($request->get('optradio')) as $key => $q) {
                    foreach (array_values($request->get('q4')) as $ky => $p) {
                        if ($k == $key && $k==$ky) {
                            $result[] = [
                                'keyVal' => $i++,
                                'question' => $p,
                                'answer' => $q,
                                'question_type' => 'true_false',
                                'rating' => 5,
                                'response' => $r
                            ];
                        }
                    }
                }
            }
        }

        AppraisalProcess::find($request->get('id'))->update([
           'evaluator_id' => Auth::id(),
            'status' => AppraisalProcess::STATUS_APPROVED,
            'evaluator_response' => json_encode($result)
        ]);

        Session::flash('success','Appraisal Approved successfully');
        return redirect('/processing');

    }

//    public function updateAppraisal(Request $request)
//    {
//        //dd($request->all());
//        $result = [];
//        $i=1;
//        if ($request->has('qe1')) {
//            foreach ($request->get('qe2') as $key => $q) {
//                foreach ($request->get('q1') as $ky => $p) {
//                    $result[] = [
//                        'keyVal' => $i++,
//                        'question' => $q,
//                        'answer' => $p,
//                        'question_type' => 'numeric',
//                        'rating' => 5
//
//                    ];
//                }
//            }
//        }
//
//        foreach ($request->get('qe2') as $key => $q) {
//            foreach ($request->get('q2') as $ky => $p) {
//                $result[] = [
//                    'keyVal' => $i++,
//                    'question' => $q,
//                    'answer' => $p,
//                    'question_type' => 'text',
//                    'rating' => 5
//
//                ];
//            }
//        }
//
//        if ($request->has('qe3')) {
//            foreach ($request->get('qe3') as $key => $q) {
//                foreach ($request->get('q3') as $ky => $p) {
//
//                    $result[] = [
//                        'keyVal' => $i++,
//                        'question' => $q,
//                        'answer' => $p,
//                        'question_type' => 'stars',
//                        'rating' => 5
//
//                    ];
//                }
//            }
//        }
//
//
//        if ($request->has('qe4')) {
//            foreach (array_values($request->get('optradio')) as $key => $q) {
//                foreach (array_values($request->get('qe4')) as $ky => $p) {
//                     $result[] = [
//                        'keyVal' => $i++,
//                        'question' => $p,
//                        'answer' => $q,
//                        'question_type' => 'true_false',
//                        'rating' => 5
//
//                    ];
//                }
//            }
//        }
//
//        AppraisalProcess::find($request->get('id'))->update([
//            'answers' => json_encode($result)
//        ]);
//        return redirect('/appraisal-master');
//    }

    public function finalizeAppraisal($id)
    {
       $appraisal=AppraisalProcess::find($id);
       return view('appraisal_master.process.finalize')->with('process',$appraisal);
    }

    public function showAppraisal($id)
    {
        $appraisal=AppraisalProcess::find($id);
        return view('appraisal_master.process.finalize_show')->with('process',$appraisal);
    }

    public function finalUpdate($id)
    {
        $appraisal=AppraisalProcess::find($id);

        dd(request()->get('a2'));
    }

    public function ApproveAppraisal($id)
    {
        AppraisalProcess::find($id)->update(['status' => AppraisalProcess::STATUS_ACCEPTED]);
        Session::flash('success','Appraisal successfully Approved');
        return redirect('processing');
    }
    public function rejectAppraisal($id)
    {
        AppraisalProcess::find($id)->update(['status' => AppraisalProcess::STATUS_REJECTED]);
        Session::flash('success','Appraisal successfully Rejected');
        return redirect('processing');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
