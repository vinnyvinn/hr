<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Http\Requests\UserRequest;

use Event;
use App\Events\RegisterUserEvent;
use App\Department;
use App\DesignationItem;
use App\Role;
use App\CutOff;
use Auth;
use Intervention\Image\Facades\Image;
use Letters\Models\IssuedWarning;
use Letters\Models\IssuedAppreciation;
use Excel;
use Faker\Factory as Faker;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function user()
    {
		$user = User::findOrFail(1);
		Event::fire(new RegisterUserEvent($user));
    }

    public function importForm()
    {
        return view('users.import');
    }

    public function importEmployees()
    {
        $path = request()->file('users')->getRealPath();
        $data = Excel::load($path)->get();
        $faker = Faker::create();
        if($data->count()) {
            foreach ($data as $key => $value) {
                 User::create([
                  'first_name' => $value->first_name ? $value->first_name:$faker->firstName ,
                  'last_name' => $value->last_name ? $value->last_name :$faker->lastName,
                  'birthday' => $value->gender=='MALE' ? 'M' : 'F',
                  'email' => $value->email ? $value->email : $faker->email,
                  'telephone' => $value->telephone,
                  'cellphone' => $value->cellphone,
                  'family_contact' => $value->family_contact,
                  'emergency_contact' => $value->emergency_contact,
                  'first_guarantor' => $value->guarantor1_contact,
                  'second_guarantor' => $value->guarantor_contact2,
                  'local_address' => $value->local_address,
                  'permanent_address' => $value->permanent_address,
                  'employee_id' => $value->payroll_no,
                  'department_id' => intval($value->department),
                  'designation_item_id' => intval($value->designation),
                  'date_hired' => $value->date_hired,
                  'probation_from' => $value->probation_from,
                  'salary' => $value->salary,
                  'nssf' => $value->nssf,
                  'nhif' => $value->nhif,
                  'kra' => $value->kra,
                  'username' => $faker->userName,
                  'password' => 'password'
               ]);
            }
        }
                dd($data);
    }
    public function index()
    {
		if(Auth::user()->role->role_permission('view_users')){
			if(Auth::user()->role->role_permission('view_users')->level == 'all'){
				$users = User::paginate(30);
			}elseif(Auth::user()->role->role_permission('view_users')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->paginate(30);
			}else{
				$users = User::where('id', Auth::user()->id)->paginate(30);
			}
			return view('users.index', compact('users'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_users')){
			if(Auth::user()->role->role_permission('view_users')->level == 'all'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->paginate(50);
			}elseif(Auth::user()->role->role_permission('view_users')->level == 'team'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('department_id', Auth::user()->department_id)->paginate(50);
			}else{
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('id', Auth::user()->id)->paginate(30);
			}
			return view('users.index', compact('users'));
		}else{
			abort(403);
		}
	}
    //walla
    public function create()
    {
		if(Auth::user()->role->role_permission('create_users')){
			$departments = [''=>''] + Department::pluck('department', 'id')->toArray();
			$designation_items = [''=>''] + DesignationItem::pluck('designation_item', 'id')->toArray();
			$roles = [''=>''] + Role::pluck('role', 'id')->toArray();
			return view('users.create', compact('departments', 'designation_items', 'roles'));
		}else{
			abort(403);
		}
    }
	
    public function store(UserRequest $request)
    {



        $data= $request->all();

        if($request->has('profile_picture')){

            $imageName = time().'.'.request()->profile_picture->getClientOriginalExtension();
            request()->profile_picture->move(public_path('images'), $imageName);
            $data['profile_picture'] = $imageName;
        }
       	$user = User::create($data);
       return redirect('users')->withSuccess($user->first_name.' '.$user->last_name.' has been saved.');

    }
	
    public function show(User $user,$id)

    {


		if(Auth::user()->role->role_permission('view_users')){
			if(Auth::user()->role->role_permission('view_users')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$user = User::where('id', $user->id)->whereIn('id', $users)->first();
				$warnings = IssuedWarning::where('user_id',$user->id)->get();
				$appreciation = IssuedAppreciation::where('user_id',$user->id)->get();
			}elseif(Auth::user()->role->role_permission('view_users')->level == 'self'){
				$user = User::where('id', Auth::user()->id)->first();
				$warnings = IssuedWarning::where('user_id',Auth::user()->id)->get();
				$appreciation = IssuedAppreciation::where('user_id',Auth::user()->id)->get();
			}
			$cut_offs = [''=>''] + CutOff::all()->pluck('cut_off', 'id')->toArray();

			$warnings = IssuedWarning::where('user_id',$user->id)->get();
			$appreciation = IssuedAppreciation::where('user_id',$user->id)->get();

			return view('users.show', compact('cut_offs','warnings','appreciation'))->with('user',User::find($id));
		}else{
			abort(403);
		}
    }
	
    public function edit(User $user,$id)
    {

        if (User::find($id)->role->layput==0){
            return view('users.edit_personal_details')->with('user',User::find($id));
        }
		if(Auth::user()->role->role_permission('edit_users')){
			if(Auth::user()->role->role_permission('edit_users')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$user = User::where('id', $user->id)->whereIn('user_id', $users)->first();
			}elseif(Auth::user()->role->role_permission('edit_users')->level == 'self'){
				$user = User::where('id', Auth::user()->id)->first();
			}
			$departments = [''=>''] + Department::pluck('department', 'id')->toArray();
			$designation_items = [''=>''] + DesignationItem::pluck('designation_item', 'id')->toArray();
			$roles = [''=>''] + Role::pluck('role', 'id')->toArray();
//            dd($user);
			return view('users.edit', compact('departments', 'designation_items', 'roles'))->with('user',User::find($id));
		}else{
			abort(403);
		}
    }
	
    public function update(Request $request, $id)
    {

        $data= $request->all();
        $user = User::find($id);
        $user->update($data);
        if (User::find(Auth::id())->role->layout ==0){
            return redirect('/')->withSuccess($user->first_name.' '.$user->last_name.' has been updated.');
        }
			return redirect('users/'.$user->id)->withSuccess($user->first_name.' '.$user->last_name.' has been updated.');

    }
	
    public function destroy(User $user)
    {
		if(Auth::user()->role->role_permission('delete_users')){
			$user->delete();
			return redirect('users')->withSuccess($user->first_name.' '.$user->last_name.' has been deleted.');
		}else{
			abort(403);
		}
    }
}
