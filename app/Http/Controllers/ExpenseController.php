<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Expense;
use App\Http\Requests\ExpenseRequest;
use App\User;
use Auth;

class ExpenseController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		if(Auth::user()->role->role_permission('view_expenses')){
			if(Auth::user()->role->role_permission('view_expenses')->level == 'all'){
				$expenses = Expense::paginate(30);
			}elseif(Auth::user()->role->role_permission('view_expenses')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$expenses = Expense::whereIn('user_id', $users)->paginate(30);
			}else{
				$expenses = Expense::where('user_id', Auth::user()->id)->paginate(30);
			}
			return view('expenses.index', compact('expenses'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_expenses')){
			if(Auth::user()->role->role_permission('view_expenses')->level == 'all'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->get();
				$expenses = Expense::whereIn('user_id', $users->pluck('id'))->orWhere('item_name', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
			}elseif(Auth::user()->role->role_permission('view_expenses')->level == 'team'){
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('department_id', Auth::user()->department_id)->pluck('id');
				$expenses = Expense::whereIn('user_id', $users)->paginate(30);
			}else{
				$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->where('id', Auth::user()->id)->pluck('id');
				$expenses = Expense::whereIn('user_id', $users)->paginate(30);
			}
			return view('expenses.index', compact('expenses'));
		}else{
			abort(403);
		}
	}
    
    public function create(User $user)
    {

			return view('expenses.create', compact('user'))->with('employees',User::all());

    }
	
    public function store(ExpenseRequest $request, User $user)
    {
		if(Auth::user()->role->role_permission('create_expenses')){
			$expense = Expense::create($request->all());
			return redirect(isset($user->id) ? 'users/'.$user->id : 'expenses')->withSuccess($expense->item_name.' has been saved.');
		}else{
			abort(403);
		}
    }
	
    public function show(Expense $expense)
    {
		return redirect('expenses');
		if(Auth::user()->role->role_permission('view_expenses')){
			if(Auth::user()->role->role_permission('view_expenses')->level == 'team'){
				$users = User::where('department_id', Auth::user()->department_id)->pluck('id');
				$expense = Expense::where('id', $expense->id)->whereIn('user_id', $users)->first();
			}elseif(Auth::user()->role->role_permission('view_expenses')->level == 'self'){
				$expense = Expense::where('id', $expense->id)->where('user_id', Auth::user()->id)->first();
			}
			return $expense ? $expense : abort(403);
		}else{
			abort(403);
		}
    }
	
    public function edit($id)
    {
          $expense= Expense::findOrFail($id);
			return  view('expenses.edit', compact('expense'))->with('employees',User::all());

    }
	
    public function update(ExpenseRequest $request, $id)
    {
		    Expense::findOrFail($id)->update($request->all());
			return redirect('expenses')->withSuccess($request->get('item_name').' has been updated.');

    }
	
    public function destroy(Expense $expense)
    {
		if(Auth::user()->role->role_permission('delete_expenses')){
			$expense->delete();
			return redirect('expenses')->withSuccess($expense->item_name.' has been deleted.');
		}else{
			abort(403);
		}
    }
}
