<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BankAccount;
use App\Http\Requests\BankAccountRequest;
use App\User;
use Auth;

class BankAccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
        if(Auth::user()->role->role_permission('view_bank_accounts')){
			$bank_accounts = BankAccount::paginate(30);
			return view('bank-accounts.index', compact('bank_accounts'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_bank_accounts')){
			$users = User::whereRaw("(CONCAT(first_name,' ',last_name) like ?)", ['%'.$request->get('term').'%'])->paginate(50);
			$bank_accounts = BankAccount::whereIn('user_id', $users->pluck('id'))->paginate(30);
			return view('bank-accounts.index', compact('bank_accounts'));
		}else{
			abort(403);
		}
	}
    
    public function create(User $user)
    {

			if($user->bank_account){
				return redirect('users/'.$user->id.'/bank-account/'.$user->bank_account->id.'/edit');
			}else{
				return view('bank-accounts.create', compact('user'))->with('employees',User::all())->with('bank_account',BankAccount::first());
			}

    }
	
    public function store(BankAccountRequest $request, User $user)
    {
		if(Auth::user()->role->role_permission('create_bank_accounts')){
			$bank_account = BankAccount::create($request->all());
			return redirect(isset($user->id) ? 'users/'.$user->id : 'bank-accounts')->withSuccess($bank_account->account_name.' has been saved.');
		}else{
			abort(403);
		}
    }
	
    public function show(BankAccount $bank_account)
    {
        if(Auth::user()->role->role_permission('view_bank_accounts')){
			return $bank_account;
		}else{
			abort(403);
		}
    }
	
    public function edit($id)
    {
        $bank_account= BankAccount::find($id);
			return view('bank-accounts.edit', compact('bank_account', 'user'))->with('employees',User::all());

    }
	
    public function update($id)
    {

        BankAccount::find($id)->update(request()->all());
			return redirect('bank-accounts')->withSuccess('Bank account has been updated.');

    }
	
    public function destroy($id)
    {
        $bank_account = BankAccount::find($id);
        $bank_account->delete();
        return redirect('bank-accounts')->withSuccess($bank_account->account_name . ' has been deleted.');
    }
}
