<?php

namespace Letters\Controllers;
use App\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Letters\Models\Warning;
use Illuminate\Support\Facades\Auth;
use App\User;
use Letters\Models\IssuedWarning;
use Illuminate\Support\Facades\Input;
use Email;

class WarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    // public function __construct()
    // {
    //         $this->middleware('auth');
    // }

    public function index()
    {
        $warning=Warning::get();

        return view('warnings.index',['warnings'=>$warning]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('warnings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->file('document');
        $name = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('documents/'),$name);

        $this->validate($request,[
            'title' =>'required',
            'subject' => 'required',
            'description'=> 'required',

        ]);
        $data = $request->all();
        $data['document'] = $name;
        Warning::create($data);
         return redirect('warning');

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
        $warning=Warning::find($id);

        return view('warnings.show',['users'=>$users,'warning'=>$warning]);
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


    public function sendWarning(Request $request){

        $this->validate($request, [
                'title' => 'required',
                'subject' => 'required',
                'description' => 'required',
                'id' => 'required'
            ]);

        $sendWarning = new  IssuedWarning();
        $sendWarning->user_id = $request->id;
        $sendWarning->title = $request->title;
        $sendWarning->subject = $request->subject;
        $sendWarning->description = $request->description;

        $sendWarning->save();

        if(Input::get('mail') != null){

        $recepient = User::find($request->id);

        \Mail::send('emails.templates', ['data' => $request->get('description')], function($message) use($request,$recepient)
            {
                $message->to($recepient->email, $recepient->first_name)->subject($request->subject);
            });
        }
        return redirect()->route('issued.index');


    }
}
