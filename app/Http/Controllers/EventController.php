<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use App\Http\Requests\EventRequest;
use Auth;

class EventController extends Controller
{
		public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
			if(Auth::user()->role->role_permission('view_events')){
				$events = Event::orderBy('date_start', 'desc')->paginate(30);
				return view('events.index', compact('events'));
			}else{
				abort(403);
			}
    }
	
		public function search(Request $request)
		{
			if(Auth::user()->role->role_permission('view_events')){
				$events = Event::where('event_name', 'LIKE', '%'. $request->get('term') .'%')->paginate(30);
				return view('events.index', compact('events'));
			}else{
				abort(403);
			}
		}
    
    public function create()
    {
			if(Auth::user()->role->role_permission('create_events')){

				return view('events.create')->with('departments',Department::all());
			}else{
				abort(403);
			}
    }
	
    public function store(EventRequest $request)
		{
		   //dd($request->all());
			if(Auth::user()->role->role_permission('create_events')){
				$event = Event::create($request->all());
				return redirect('events')->withSuccess($event->event_name.' has been saved.');
			}else{
				abort(403);
			}
    }
	
    public function show(Event $event)
    {
			if(Auth::user()->role->role_permission('view_events')){
				return view('events.show', compact('event'));
			}else{
				abort(403);
			}
    }
	
    public function edit($id)
    {
			$event = Event::find($id);
				return view('events.edit', compact('event'))->with('departments',Department::all());

    }
	
    public function update(Request $request,$id)
    {
              $event = Event::find($id);
				$event->update($request->all());
				return redirect('events')->withSuccess($event->event_name.' has been updated.');

    }
	
    public function destroy($id)
    {
        $event = Event::find($id);
				$event->delete();
				return redirect('events')->withSuccess($event->event_name.' has been deleted.');

    }
}
