<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/20/16
 * Time: 3:51 PM
 */

namespace App\Http\Controllers;

use App\Department;
use App\User;
use illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Vinn\Repository\ReportsRepo;


class DepartmentReportController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function create()
    {
        $departments = Department::all();

        return view('reports.department.create')->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $department = ReportsRepo::init()->getDepartments();
          if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.department.report',compact('department'));
            return $pdf->download('department.pdf');
        }
        $excel = Excel::create('department', function ($excel) use ($department)
        {

            $excel->sheet('New sheet', function ($sheet) use ($department)
            {
                $sheet->fromArray($department);

                ///$sheet->loadView('reports.department.report')->withdepartments($department);

            });

        })->download($request->get('format'));


        dd($excel);
    }
}
