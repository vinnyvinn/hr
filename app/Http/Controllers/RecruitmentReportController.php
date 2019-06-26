<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/19/16
 * Time: 4:26 PM
 */

namespace App\Http\Controllers;

use App\Candidate;
use App\JobVacancy;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class RecruitmentReportController extends Controller {

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
        return view('reports.recruitment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$startDate = Carbon::parse($request->get('start_date'));
        //$endDate = Carbon::parse($request->get('end_date'));

        //dd(JobVacancy::with(['candidates'])->get()->toArray());

        $vacancy = JobVacancy::where('id', '=', 1)
            ->with(['candidates'])
            ->first();

        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.recruitment.report',compact('vacancy'));
            return $pdf->download('recruitment.pdf');
        }


        Excel::create('recruitment', function($excel) use ($vacancy) {

            $excel->sheet('New sheet', function($sheet) use ($vacancy) {
                $sheet->fromArray($vacancy);
                ///$sheet->loadView('reports.recruitment.report')->with('vacancy', $vacancy);

            });

        })->download($request->get('format'));
    }

}
