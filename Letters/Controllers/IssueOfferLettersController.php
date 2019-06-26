<?php

namespace Letters\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\JobVacancy;
use App\Http\Controllers\Controller;
use App\Candidate;
use Illuminate\Support\Facades\Mail;
use Letters\Models\OfferLetter;
use Letters\Models\Offered;


class IssueOfferLettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
            $jobs=JobVacancy::get();    
        return view('offer-letters.issue.index',['jobs'=>$jobs]);
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

        $candidate = Candidate::findOrFail($request->id);
        $templates = OfferLetter::findOrFail($request->offer_template);

        $offered=new Offered();
        $offered->candidate_id = $request->id;
        $offered->title = $templates->title;
        $offered->template = $templates->description;
        if($request->hasFile('attachments')){
        
          Mail::send('emails.templates', ['data' =>$templates->description ], function($message) use($request,$candidate,$templates)
            {
                $message->to($candidate->email, $candidate->first_name)->subject($templates->title);
                $message->attach($request->attachments);

            });

        $offered->attachement = "get file attached";
    
        }else{
           // dd($templates);
     
          Mail::send('emails.templates', ['data' =>$templates->description ], function($message) use($candidate,$templates)
            {
                $message->to($candidate->email, $candidate->first_name)->subject($templates->title);
            });
      }
        $offered->save();

        return redirect('offer-letter');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        $templates = OfferLetter::get();

        return view('offer-letters.issue.show',['candidate'=>$candidate,'templates' => $templates]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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


    public function getCandidate(Request $request){

        $this->validate($request,[
            'job_id'=>'required'
        ]);

        $candidates= Candidate::where('job_vacancy_id',$request->job_id)->where('status',2)->get();

        return view('offer-letters.issue.index',['candidates'=>$candidates]);
    }
}
