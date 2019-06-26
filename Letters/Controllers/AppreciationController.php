<?php

namespace Letters\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Letters\Models\AppreciationTemplate;
use App\User;
use Letters\Models\IssuedAppreciation;
use Illuminate\Support\Facades\Input;
use Email;

class AppreciationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appreciations=AppreciationTemplate::get();

        return view('appreciation.index',['appreciations'=>$appreciations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('appreciation.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'subject' => 'required',
            'description'=> 'required'
        ]);
        $template=new AppreciationTemplate();
            $template->title =  $request->title;
            $template->subject = $request->subject;
            $template->description =  $request->description;
        if($template->save()){
            return redirect()->route('appreciation.index');     
        }

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users=User::get();
        $appreciationTemp=AppreciationTemplate::find($id);

        return view('appreciation.show',['users'=>$users,'appreciationTemp'=>$appreciationTemp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $destory=Warning::where('id',$id)->delete();

        return redirect()->back();
    }
     public function sendAppreciation(Request $request){

        $this->validate($request, [
                'title' => 'required',
                'subject' => 'required',
                'description' => 'required',
                'id' => 'required'
            ]);

        $issue = new  IssuedAppreciation();
        $issue->user_id = $request->id;
        $issue->title = $request->title;
        $issue->subject = $request->subject;
        $issue->description = $request->description;

        $issue->save();

        if(Input::get('mail') != null){
        $recepient = User::find($request->id);

        \Mail::send('emails.templates', ['data' => $request->get('description')], function($message) use($request,$recepient)
            {
                $message->to($recepient->email, $recepient->first_name)->subject($request->subject);
            });
        }
        return redirect()->route('issued-appreciation.index');


    }
}
