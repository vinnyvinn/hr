<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Candidate;
use App\Http\Requests\CandidateRequest;
use App\JobVacancy;
use App\RecruitmentType;
use App\Escalation;
use Letters\Models\AppicationStatus;
use Auth;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        if(Auth::user()->role->role_permission('view_candidates')){
			$candidates = Candidate::with(['recruitments.process','recruitments.application'])
				->paginate(30);
			return view('candidates.index', compact('candidates'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_candidates')){
			$candidates = Candidate::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->orWhere('status', 'LIKE', '%'. $request->get('term') .'%')->orWhere('comment', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
			return view('candidates.index', compact('candidates'));
		}else{
			abort(403);
		}
	}
    
    public function create()
    {
		if(Auth::user()->role->role_permission('create_candidates')){

			$job_vacancies = [''=>''] + JobVacancy::where('status', 1)->pluck('job_title', 'id')->toArray() ;


			$status = AppicationStatus::get();

			$jobtypes= RecruitmentType::get();
			return view('candidates.create', compact('job_vacancies','status','jobtypes'));
		}else{
			abort(403);
		}
    }
	
    public function store(Request $request)
    {

		if(Auth::user()->role->role_permission('create_candidates')){
			$created = Candidate::create($request->all())->id;
			$candidate =Candidate::where('id',$created)->first();
			//initialize interview process
			$getAllProcess=RecruitmentType::where('id',$request->recruitment_type)
							->with('process')
							->first();

			foreach($getAllProcess->process as $pros){
				Escalation::create([
					'candidate_id' => $candidate->id,
					'recruitment_id' => $request->recruitment_type,
					'process_id' => $pros->id,
				]);
			}
			
			$this->updateCandidateStatus($candidate,$request);

		return redirect('candidates')->withSuccess($candidate->first_name.' '.$candidate->last_name.' has been saved.');
		}else{
			abort(403);
		}
    }
	
    public function download($id)
    {
        $candidate = Candidate::find($id);
		if(Auth::user()->role->role_permission('view_candidates')){
			return $candidate ? response()->download(public_path($candidate->resume)) : abort(403);
		}else{
			abort(403);
		}
    }
	
	public function show($id)
    {

			$nextLevel = Escalation::where('candidate_id',$id)->with(['process','application'])->get();
			$status=AppicationStatus::get();
			$candidate = Candidate::find($id);
			return view('candidates.show', compact('candidate','nextLevel','status'));

    }
	
    public function edit($id)
    {
		    $candidate =  Candidate::findOrFail($id);
			$job_vacancies = JobVacancy::all();
            $jobtypes= RecruitmentType::get();
            $status = AppicationStatus::get();
			return view('candidates.edit', compact('candidate', 'job_vacancies','jobtypes','status'));

    }
	
    public function update(Request $request, $id)
    {

			Candidate::find($id)->update($request->all());
			return redirect('candidates')->withSuccess($request->first_name.' '.$request->last_name.' has been updated.');

    }
	
    public function destroy($id)
    {
		if(Auth::user()->role->role_permission('delete_candidates')){
            $candidate = Candidate::find($id);
			$candidate->delete();
			return redirect('candidates')->withSuccess($candidate->first_name.' '.$candidate->last_name.' has been deleted.');
		}else{
			abort(403);
		}
    }


    public function updateCandidateStatus($candidate,$request){

			$status = AppicationStatus::where('id',$request->status)->first();

			if($status->type == 0){
				Escalation::where('candidate_id',$candidate->id)->where('recruitment_id' ,$request->recruitment_type)->update(
							['comment'=>$request->comment,
							'application_status'=>$status->id,
							'esc_status'=>0]
						);
			}else{
    		$escalation = Escalation::where('candidate_id',$candidate->id)->where('recruitment_id' , $request->recruitment_type)->first();
    		$escalation->update(['application_status'=>$status->id,
    						]);

			}
    }


    public function updateRecruitment(Request $request){

    	$this->validate($request,[
    		'candidate_id' => 'required',
    		'process_id' => 'required',
    		'status' => 'required',
    		'comment' => 'required' ,
    		'recruitment_id'=>'required'
    	]);

    	$status=AppicationStatus::where('id',$request->status)->first();

		if($status->type == 0){
			Escalation::where('candidate_id',$request->candidate_id)
				->where('recruitment_id' ,$request->recruitment_id)
				->update([
					'comment'=>$request->comment,
					'application_status'=>$status->id,
					'esc_status'=>0
				]);
			}elseif($status->type == 1){
	    $escalation = Escalation::where('candidate_id',$request->candidate_id)
	    				->where('recruitment_id' , $request->recruitment_id)
	    				->where('process_id',$request->process_id)
	    				//->whereNotIn('esc_status',array(1,2,3))
	    				->first();
		$escalation->update([
					'comment'=>$request->comment,
					'esc_status' =>0
    						]);
		$id=$escalation->id+1;


		// $nextLevel = Escalation::where('candidate_id',$request->candidate_id)
	 //    				->where('recruitment_id' , $request->recruitment_id)
	 //    				->where('process_id',$request->process_id)
	 //    				->whereNull('esc_status')
	 //    				->first();
	    Escalation::where('candidate_id',$request->candidate_id)
	    				->update([
									'application_status'=>$request->status,
    							]);
	    Candidate::where('id',$request->candidate_id)->update(['status' => 3]);

		}else{
			Escalation::where('candidate_id',$request->candidate_id)
				->where('recruitment_id' ,$request->recruitment_id)
				->update([
					'comment'=>$request->comment,
					'application_status'=>$status->id,
					'esc_status'=>0
				]);
		}


		return redirect()->back();

    }
}
