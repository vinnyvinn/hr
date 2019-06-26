<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Vinn\Repository\ReportsRepo;

class EmployeeReportController extends Controller
{
    //
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $departments = Department::all(['id', 'department']);

        return view('reports.user.create')->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departmentId = $request->get('department_id');

        if ($departmentId == 'all') {
            $employees = User::all([
                'employee_id', 'first_name', 'last_name', 'email', 'cellphone'
            ]);
        } else {
            $employees = User::where('department_id', '=', $departmentId)->get([
                'employee_id', 'first_name', 'last_name', 'email', 'cellphone'
            ]);
        }
        $all_employees=ReportsRepo::init()->getEmployess($employees);
        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.user.report',compact('employees'));
            return $pdf->download('employees.pdf');
        }

        Excel::create('Employees', function ($excel) use ($all_employees)
        {

            $excel->sheet('New sheet', function ($sheet) use ($all_employees)
            {
                $sheet->fromArray($all_employees);
              ///  $sheet->loadView('reports.user.report')->with('users', $employees);

            });

        })->download($request->get('format'));
    }

}
