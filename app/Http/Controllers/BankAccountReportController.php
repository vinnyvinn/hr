<?php
/**
 * Created by PhpStorm.
 * User: koi
 * Date: 9/16/16
 * Time: 5:04 PM
 */

namespace App\Http\Controllers;

use App\BankAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Vinn\Repository\ReportsRepo;


class BankAccountReportController extends Controller {
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
        return view('reports.bankAccount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$startDate = Carbon::parse($request->get('start_date'));
        //$endDate = Carbon::parse($request->get('end_date'));

        $bankAccount = ReportsRepo::init()->getBankAccounts();
        $bankAccounts = BankAccount::all();
        if ($request->get('format') =='pdf'){
            $pdf = PDF::loadView('reports.bankAccount.report',compact('bankAccounts'));
            return $pdf->download('bankAccount.pdf');
        }
        $excel = Excel::create('BankAccount', function ($excel) use ($bankAccount)
        {

            $excel->sheet('New sheet', function ($sheet) use ($bankAccount)
            {

                $sheet->fromArray($bankAccount);

            });

        })->download($request->get('format'));


        dd($excel);
    }

}
