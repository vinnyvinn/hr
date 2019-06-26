<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notice;
use App\Http\Requests\NoticeRequest;
use Auth;
use Mockery\Matcher\Not;

class NoticeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		if(Auth::user()->role->role_permission('view_notices')){
			$notices = Notice::orderBy('created_at', 'desc')->paginate(30);
			return view('notices.index', compact('notices'));
		}else{
			abort(403);
		}
    }
	
	public function search(Request $request)
	{
		if(Auth::user()->role->role_permission('view_notices')){
			$notices = Notice::where('title', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
			return view('notices.index', compact('notices'));
		}else{
			abort(403);
		}
	}
    
    public function create()
    {
		if(Auth::user()->role->role_permission('create_notices')){
			return view('notices.create');
		}else{
			abort(403);
		}
    }
	
    public function store(NoticeRequest $request)
    {
		if(Auth::user()->role->role_permission('create_notices')){
			$notice = Notice::create($request->all());
			return redirect('notices')->withSuccess($notice->title.' has been saved.');
		}else{
			abort(403);
		}
    }
	
    public function show($id)
    {
		if(Auth::user()->role->role_permission('view_notices')){
			return view('notices.show')->with('notice',Notice::findOrFail($id));
		}else{
			abort(403);
		}
    }
	
    public function edit($id)
    {
            $notice = Notice::find($id);
			return view('notices.edit', compact('notice'));

    }
	
    public function update(Request $request ,$id)
    {
            $notice = Notice::find($id);
			$notice->update($request->all());
			return redirect('notices')->withSuccess($notice->title.' has been updated.');

    }
	
    public function destroy($id)
    {
        $notice = Notice::find($id);
			$notice->delete();
			return redirect('notices')->withSuccess($notice->title.' has been deleted.');

    }
}
