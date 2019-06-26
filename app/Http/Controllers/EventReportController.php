<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/17/16
 * Time: 9:17 AM
 */

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Vinn\Repository\ReportsRepo;
use PDF;

class EventReportController extends Controller {

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
        return view('reports.event.create');
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
        $events = Event::whereBetween('created_at', [$startDate, $endDate])->get();

        $event = ReportsRepo::init()->getEvents($startDate,$endDate);
        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.event.report',compact('events'));
            return $pdf->download('events.pdf');
        }

        $excel = Excel::create('event', function ($excel) use ($event)
        {

            $excel->sheet('New sheet', function ($sheet) use ($event)
            {

                $sheet->fromArray($event);

            });

        })->download($request->get('format'));


        dd($excel);
    }

}
