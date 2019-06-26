<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/16/16
 * Time: 1:18 PM
 */

namespace App\Http\Controllers;

use App\Award;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Vinn\Repository\ReportsRepo;


class AwardReportController extends Controller {
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
        return view('reports.award.create');
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
        $awards = Award::whereBetween('created_at', [$startDate, $endDate])->get();

        $award = ReportsRepo::init()->getAwards($startDate,$endDate);
        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.award.report',compact('awards'));
            return $pdf->download('awards.pdf');
        }

        $excel = Excel::create('Award', function ($excel) use ($award)
        {

            $excel->sheet('New sheet', function ($sheet) use ($award)
            {

                $sheet->fromArray($award);

            });

        })->download($request->get('format'));


        dd($excel);
    }

}
