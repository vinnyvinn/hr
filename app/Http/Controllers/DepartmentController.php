<?php

namespace App\Http\Controllers;

use App\SubDepartment;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Department;
use App\Http\Requests\DepartmentRequest;
use App\DesignationItem;
use App\User;
use Auth;

use Session;

class DepartmentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        if(Auth::user()->role->role_permission('view_departments')){
			$departments = Department::paginate(30);
			return view('departments.index', compact('departments'));
		}else{
			abort(403);
		}
    }

	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_departments')){
			$departments = Department::where('department', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
			return view('departments.index', compact('departments'));
		}else{
			abort(403);
		}
	}
    
    public function create()
    {
		if(Auth::user()->role->role_permission('create_departments')){
			return view('departments.create');
		}else{
			abort(403);
		}
    }
	
    public function store(DepartmentRequest $request)
    {
		if(Auth::user()->role->role_permission('create_departments')){
			$department = Department::create($request->all());
			return redirect('departments')->withSuccess($department->department.' has been saved.');
		}else{
			abort(403);
		}
    }


	
    public function show(Department $department,$id)
    {


			return view('departments.show')->with('department',Department::find($id));

    }

    public function SubDepartment()
    {

        return view('departments.add_subdepartment')->with('departments',Department::all());

    }

    public function editSubDepartment($id)
    {
        return view('departments.edit_subdepartment')->with('sub_department',SubDepartment::find($id))->with('departments',Department::all());
    }

    public function updateSub()
    {
        SubDepartment::find(request()->get('id'))->update([
            'name' => request()->get('name'),
            'department_id' => request()->get('department_id')
        ]);
        Session::flash('success', 'Sub-Department has been updated.');
        return redirect('departments/'.request()->get('department_id'));
   }
    public function addSub(){

	    SubDepartment::create([
	        'name' => request()->get('name'),
            'department_id' => request()->get('department_id')
        ]);
        Session::flash('success', 'Sub-Department has been saved.');
        return redirect('departments/'.request()->get('department_id'));
    }

    public function deleteSub($id)
    {

        SubDepartment::destroy($id);
        Session::flash('success', 'Sub-Department has been deleted.');
        return redirect()->back();
    }

    public function edit(Department $department,$id)
    {
		if(Auth::user()->role->role_permission('edit_departments')){
			return view('departments.edit')->with('department',Department::find($id));
		}else{
			abort(403);
		}
    }
	
    public function update(Request $request,$id)
    {
        $department =  Department::find($id);
			$department->update($request->all());
			return redirect('departments')->withSuccess($department->department.' has been updated.');

    }
	
    public function destroy($id)
    {
        $department = Department::find($id);
			$department->delete();
			return redirect('departments')->withSuccess($department->department.' has been deleted.');

    }


}
