<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Http\Requests\RoleRequest;
use App\Permission;
use App\RolePermission;
use Auth;

class RoleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		if(Auth::user()->role->id == 1){
			$roles = Role::paginate(30);
			return view('roles.index', compact('roles'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->id == 1){
			$roles = Role::where('role', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
			return view('roles.index', compact('roles'));
		}else{
			abort(403);
		}
	}
    
    public function create()
    {
		if(Auth::user()->role->id == 1){
			$permissions = Permission::all();
			return view('roles.create', compact('permissions'));
		}else{
			abort(403);
		}
    }
	
    public function store(RoleRequest $request)
    {
		if(Auth::user()->role->id == 1){
			$role = Role::create($request->all());
			$permissions = Permission::all();

			foreach($permissions as $permission){

				if($request->get($permission->permission)){
					$role->role_permissions()->create(['permission_id' => $permission->id, 'level' => $request->get('level-'.$permission->id)]);
				}
			}
			return redirect('roles')->withSuccess($role->role.' has been saved.');
		}else{
			abort(403);
		}
    }
	
    public function show(Role $role)
    {
		if(Auth::user()->role->id == 1){
			return $role;
		}else{
			abort(403);
		}
    }
	
    public function edit($id)
    {
		    $role = Role::find($id);
			$permissions = Permission::all();
			return view('roles.edit', compact('role', 'permissions'));

    }
	
    public function update(Request $request,$id)
    {
        $role = Role::find($id);
			$role->update($request->all());
			$permissions = Permission::all();
			foreach($permissions as $permission){
				if($request->get($permission->permission)){
					if($role->role_permissions->where('permission_id', $permission->id)->count() == 0){
						$role->role_permissions()->create(['permission_id' => $permission->id, 'level' => $request->get('level-'.$permission->id)]);
					}else{
						$role->role_permissions()->where('permission_id', $permission->id)->update(['level' => $request->get('level-'.$permission->id)]);
					}
				}elseif($role->role_permissions->where('permission_id', $permission->id)->count()){
					$role_permission = $role->role_permissions->where('permission_id', $permission->id)->first();
					$role_permission->delete();
				}
			}
			return redirect('roles')->withSuccess($role->role.' has been updated.');

    }
	
    public function destroy($id)
    {
		    $role =  Role::find($id);
			$role->delete();
			return redirect('roles')->withSuccess($role->role.' has been deleted.');

    }
}
