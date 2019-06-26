<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Designation;
use App\Http\Requests\DesignationRequest;
use App\User;
use App\DesignationItem;
use Auth;

class DesignationController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		if(Auth::user()->role->role_permission('view_designations')){
			if(Auth::user()->role->role_permission('view_designations')->level == 'all'){
				$designations = Designation::paginate(30);
			}elseif(Auth::user()->role->role_permission('view_designations')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$designations = Designation::whereIn('user_id', $users)->paginate(30);
			}else{
				$designations = Designation::where('user_id', Auth::user()->id)->paginate(30);
			}
			$designations = Designation::paginate(30);
			return view('designations.index', compact('designations'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_designations')){
			if(Auth::user()->role->role_permission('view_designations')->level == 'all'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->get();
				$designations = Designation::whereIn('user_id', $users->pluck('id'))->paginate(30);
			}elseif(Auth::user()->role->role_permission('view_designations')->level == 'team'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('department_id', Auth::user()->department_id)->pluck('id');
				$designations = Designation::whereIn('user_id', $users)->paginate(30);
			}else{
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('id', Auth::user()->id)->pluck('id');
				$designations = Designation::whereIn('user_id', $users)->paginate(30);
			}
			return view('designations.index', compact('designations'));
		}else{
			abort(403);
		}
	}
    
    public function create()
    {

			$designation_items = DesignationItem::get();
			return view('designations.create', compact('designation_items'))->with('employees',User::all());

    }
	
    public function store(DesignationRequest $request)
    {

		if(Auth::user()->role->role_permission('create_designations')){
			$designation = Designation::create($request->all());
			return redirect('designations')->withSuccess('Designation has been saved.');
		}else{
			abort(403);
		}
    }
	
    public function show(Designation $designation)
    {
		if(Auth::user()->role->role_permission('view_designations')){
			if(Auth::user()->role->role_permission('view_designations')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$designation = Designation::where('id', $designation->id)->whereIn('user_id', $users)->first();
			}elseif(Auth::user()->role->role_permission('view_designations')->level == 'self'){
				$designation = Designation::where('id', $designation->id)->where('user_id', Auth::user()->id)->first();
			}
			return $designation ? $designation : abort(403);
		}else{
			abort(403);
		}
    }
	
    public function edit($id)
    {

            $designation = Designation::find($id);
			$designation_items = [''=>''] + DesignationItem::pluck('designation_item', 'id')->toArray();
			return  view('designations.edit', compact('designation', 'designation_items'));

    }
	
    public function update(DesignationRequest $request, $id)
    {
              Designation::find($id)->update($request->all());

			return redirect('designations')->withSuccess('Designation has been updated.');

    }
	
    public function destroy($id)
    {
        $designation = Designation::find($id);
			$designation->delete();
			return redirect('designations')->withSuccess('Designation has been deleted.');

    }
}
