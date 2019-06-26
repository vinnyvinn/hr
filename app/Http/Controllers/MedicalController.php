<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class MedicalController extends Controller
{
    protected $users;

    /**
     * MedicalController constructor.
     * @param $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicals = $this->users->paginate(30);
        return view('medicaldetails.index', compact('medicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicaldetails.create')->with('employees',User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        User::findOrfail($request->get('user_id'))->update([
            'blood_group' => $request->get('blood_group'),
            'doctor'=> $request->get('doctor'),
            'clinic_tel' => $request->get('clinic_tel'),
            'allergies' => $request->get('allergies'),
            'prescription' => $request->get('prescription'),
            'disabled' => $request->get('disabled')
        ]);

        return Redirect::to(url('/medical-details'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('medicaldetails.edit')
            ->withUser($this->users->findorfail($id));
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
        $data =[
            'blood_group' => $request->blood_group,
            'doctor'=> $request->doctor,
            'clinic_tel' => $request->clinic_tel,
            'allergies' => $request->allergies,
            'prescription' => $request->prescription,
            'disabled' => $request->disabled
        ];
        $this->users->findorfail($request->user_id)->update($data);

        return Redirect::to(url('/medical-details'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
