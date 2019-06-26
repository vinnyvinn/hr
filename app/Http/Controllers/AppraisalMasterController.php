<?php

namespace App\Http\Controllers;

use Auth;
use App\AppraisalMaster;
use App\AppraisalQuestion;
use App\AppraisalTemplate;
use App\Department;
use App\Designation;
use App\DesignationItem;
use App\QuestionType;
use App\User;
use Illuminate\Http\Request;
use Session;
use Vinn\Repository\Appraisals;

class AppraisalMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
if (User::find(Auth::id())->role->layout ==0){
    return view('appraisal_master.user_index')->with('templates', Appraisals::init()->getAllAppraisals());
}
       return view('appraisal_master.index')->with('templates',AppraisalMaster::all())->with('employees',User::all())
            ->with('departments',Department::all())->with('designations',DesignationItem::all())->with('sorted_templates',AppraisalMaster::where('department_id','=',null)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appraisal_master.create')->with('questions',AppraisalQuestion::all())
            ->with('templates',AppraisalTemplate::all())->with('types',QuestionType::all());
    }

    public function checkTemplate($id)
    {
        $templ = AppraisalMaster::find($id);
        if ($templ->department_id){
            return response('already_assigned');
        }
        return response('notassigned');

}

    public function appraisalStatus($id)
    {
        $template = AppraisalMaster::find($id);

        if ($template->department_id && (AppraisalMaster::STATUS_NEW || AppraisalMaster::STATUS_WIP)){
            return response('pass');
        }
        return response('fail');

}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AppraisalMaster::create([
            'template_id' => $request->get('template_id'),
            'question_id' => json_encode($request->get('question_id'))
        ]);
        Session::flash('success','Template successfully created.');
        return redirect('/appraisal-master');

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

    public function assignTemplate(Request $request)
    {
       $user_id=[];
        if($request->get('user_id')){
            array_push($user_id,$request->get('user_id'));

        }
        if($request->get('staff_id')){
            array_push($user_id,$request->get('staff_id'));
          }

        AppraisalMaster::find($request->get('template_id'))->update([
           'department_id' => $request->get('department_id'),
           'designation_id' => $request->get('designation_id'),
           'user_id' => collect($user_id)->flatten(1),
           'status' => AppraisalMaster::STATUS_WIP,

        ]);
   Session::flash('success','Template successlly assigned');
        return redirect()->back();
}

    public function getDesignations($id)
    {
        $designation_items = Department::find($id)->designation_items;
        return response()->json($designation_items);

}
public function getStaffByDesignation($id){
        $staff = DesignationItem::find($id)->users;
        return response()->json($staff);
}
    public function getAllStaff($id)
    {
        $staff = DesignationItem::find($id)->users;
        $all_staff = User::get();
        $users_found = [];
        $user_ids = [];

        foreach ($staff as $user){
            $user_ids[] = $user->id;
        }

        foreach ($all_staff as $staf){
            if(!in_array($staf->id,$user_ids)){
                $users_found[] = $staf;
            }
        }

       return response()->json($users_found);

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('appraisal_master.edit')->with('template',AppraisalMaster::find($id))->with('templates',AppraisalTemplate::all())
            ->with('questions',QuestionType::all());
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
        AppraisalMaster::find($id)->update([
            'template_id' => $request->get('template_id'),
            'question_id' => json_encode($request->get('question_id'))
        ]);

        Session::flash('success','Template successfully updated.');
        return redirect('/appraisal-master');

    }

    public function copyNew($id)
    {
        $details = AppraisalMaster::find($id);

        AppraisalMaster::create([
            'template_id' => $details->template_id,
            'question_id' => $details->question_id,
            'department_id' => $details->department_id,
            'designation_id' => $details->designation_id,
            'user_id' => $details->user_id,
            'status' => $details->status
            ]);
        return response()->json($details);
    }

    public function deleteBulk()
    {
       $templates = AppraisalMaster::whereIn('id',request()->get('id'))->delete();
       return response()->json($templates);
    }

    public function getQuestions($id)
    {
      return response()->json(json_decode(AppraisalTemplate::find($id)->questions));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AppraisalMaster::destroy($id);
        Session::flash('success','Template deleted successfully');
        return redirect()->back();
    }
}
