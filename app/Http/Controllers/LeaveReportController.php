<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/17/16
 * Time: 11:07 AM
 */

namespace App\Http\Controllers;

use App\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Vinn\Repository\ReportsRepo;
use PDF;

class LeaveReportController extends Controller
{
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
        return view('reports.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $startDate = Carbon::parse($request->get('start_date'));
        $endDate = Carbon::parse($request->get('end_date'));
        $leaves = Leave::whereBetween('created_at', [$startDate, $endDate])->get();
        $leave = ReportsRepo::init()->getLeaves($startDate, $endDate);

        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.leave.report',compact('leaves'));
            return $pdf->download('leaves.pdf');
        }


        $excel = Excel::create('leave', function($excel)  use ($leave) {

            $excel->sheet('New sheet', function($sheet) use ($leave) {
                $sheet->fromArray($leave);
               // $sheet->loadView('reports.leave.report')->with('leaves', $leave);

            });

        })->download($request->get('format'));


        dd($excel);


        return view('reports.leave.report')->withleaves($leave);
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
        //
    }
}
