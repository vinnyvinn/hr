<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/17/16
 * Time: 10:55 AM
 */

namespace App\Http\Controllers;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseReportController extends Controller {

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
        return view('reports.expense.create');
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

        $expense = Expense::with(['user'])
            ->where('purchase_date', '>=', $startDate)
            ->where('purchase_date', '<=', $endDate)
            ->orderBy('purchase_date')
            ->get();
            //dd($expense);

        $excel = Excel::create('expense', function ($excel) use ($expense)
        {

            $excel->sheet('New sheet', function ($sheet) use ($expense)
            {
                $sheet->fromArray($expense);

             //   $sheet->loadView('reports.expense.report')->withexpenses($expense);

            });

        })->download($request->get('format'));


        dd($excel);
    }
}
