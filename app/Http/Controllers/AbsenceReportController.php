<?php

namespace App\Http\Controllers;

use App\Absence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Vinn\Repository\ReportsRepo;

class AbsenceReportController extends Controller
{
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
        return view('reports.absence.create');
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
        $absencess = Absence::whereBetween('created_at', [$startDate, $endDate])->get();
        $absences = ReportsRepo::init()->getAbsences($startDate,$endDate);

        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.absence.report',compact('absencess'));
            return $pdf->download('absence.pdf');
        }

        $excel = Excel::create('Absence', function($excel)  use ($absences) {

            $excel->sheet('New sheet', function($sheet) use ($absences) {

                $sheet->fromArray($absences);

            });

        })->download($request->get('format'));





        return view('reports.absence.report')->withAbsences($absences);
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
