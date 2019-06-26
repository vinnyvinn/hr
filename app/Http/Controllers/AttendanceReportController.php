<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/16/16
 * Time: 11:10 AM
 */

namespace App\Http\Controllers;


use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;


class AttendanceReportController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $startDate = Carbon::parse($request->get('start_date'));
        $endDate = Carbon::parse($request->get('end_date'));

        $attendance = Attendance::with(['user'])
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->orderBy('date')
            ->get();

        $excel = Excel::create('Attendance', function ($excel) use ($attendance)
        {

            $excel->sheet('New sheet', function ($sheet) use ($attendance)
            {

                $sheet->loadView('reports.attendance.report')->withAttendances($attendance);

            });

        })->download($request->get('format'));


        dd($excel);
    }
}