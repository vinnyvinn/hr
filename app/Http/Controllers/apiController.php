<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Leave;
use App\User;
use Response;
use App\Department;



class apiController extends Controller
{
    //
    public function department()
    {
        $department = Department::all(['id','department','department_id','deleted_at','payment_id']);
        return Response::json($department->toArray());

    }

    public function employees()
    {
        $user = User::all();
        return Response::json($user->toArray() );
    }
    public function leaves()
    {
        $leaves = Leave::all();
        return Response::json($leaves->toArray());
    }
    public function attendance()
    {
        $attendance = Attendance::all();
        return Response::json($attendance ->toArray());
    }




}
