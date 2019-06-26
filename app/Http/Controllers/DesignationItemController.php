<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DesignationItem;
use App\Http\Requests\DesignationItemRequest;
use App\Department;
use Auth;
use Illuminate\Support\Facades\Session;

class DesignationItemController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
			$designation_items = DesignationItem::paginate(30);
			return view('designation-items.index', compact('designation_items'));

    }
	
	public function search(Request $request)
	{

			$designation_items = DesignationItem::where('designation_item', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
			return view('designation-items.index', compact('designation_items'));

	}
    
    public function create(Department $department)
    {

			$departments = [''=>''] + Department::pluck('department', 'id')->toArray();
			return view('designation-items.create', compact('department', 'departments'));

    }
	
    public function store(DesignationItemRequest $request, Department $department)
    {

			$designation_item = DesignationItem::create($request->all());
			return redirect(isset($department->id) ? 'departments/'.$department->id : 'designation-items')->withSuccess($designation_item->designation_item.' has been saved.');

    }
	
    public function show(DesignationItem $designation_item)
    {
		if(Auth::user()->role->role_permission('view_designation_items')){
			return $designation_item;
		}else{
			abort(403);
		}
    }
	
    public function edit(Department $department ,$id)
    {


		  $departments = Department::all();
			return view('designation-items.edit', compact('departments'))->with('designation_item',DesignationItem::find($id));

    }
	
    public function update(Request $request,$id)
    {

        DesignationItem::find($id)->update($request->all());
			Session::flash('success','Updated successfully');
		return redirect('designation-items');
    }
	
    public function destroy($id)
    {
        $designation_item = DesignationItem::find($id);
			$designation_item->delete();
			return redirect( 'designation-items')->withSuccess($designation_item->designation_item.' has been deleted.');

    }
}
