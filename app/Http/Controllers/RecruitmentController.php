<?php

namespace App\Http\Controllers;

use App\RecruitmentProcess;
use App\RecruitmentType;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class RecruitmentController extends Controller
{
    protected $recruitmenttype;
    protected $processx;

    /**
     * RecruitmentController constructor.
     * @param $recruitmenttype
     * @param $processx
     */
    public function __construct(RecruitmentType $recruitmenttype,RecruitmentProcess $processx)
    {
        $this->recruitmenttype = $recruitmenttype;
        $this->processx = $processx;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->recruitmenttype->with('process')->get()
        ->map(function($value)
        {
             if($value->process->count() > 0)
             {
                 return $value;
             }
        })->reject(null);
        return view('recruitmentprocess.index')
        ->withRecruits($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recruitmentprocess.create')
            ->withRecruitmenttypes($this->recruitmenttype->all()->sortBy('name'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = [];
        foreach ($request->process as $key => $process)
        {
            $data[] =
            [
            'recruitment_type_id' => $request->recruitment_type,
            'process' => $process,
                'start_date'=>Carbon::parse($start_date[$key])->toDateString(),
                'end_date'=>Carbon::parse($end_date[$key])->toDateString(),
                'created_at'=>$now,
                'updated_at'=>$now
            ];
        }
            RecruitmentProcess::insert($data);
        return redirect()->route('recruitment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->recruitmenttype->with('process')
            ->where('id',$id)->get()->map(function($value)
            {
                return
                    [
                        'name' => $value->name,
                        'desc' => $value->description,
                        'process' => $value->process->sortBy('id')->toArray()
                        ];
            });

        return view('recruitmentprocess.show')
            ->withProcess($data->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('recruitmentprocess.edit')
            ->with('typeid',$id)
            ->with('processes',RecruitmentProcess::where('recruitment_type_id',$id)->get())
            ->withRecruitmenttypes($this->recruitmenttype->all()->sortBy('name')
            );
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
        //nimechoka pasting codes
        $process_ids = $this->processx->where('recruitment_type_id',$id)->get()
            ->map(function ($value)
            {
                return $value->id;
            })->toArray();
        $this->processx->destroy($process_ids);

        $now = Carbon::now();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = [];
        foreach ($request->process as $key => $process)
        {
            $data[] =
                [
                    'recruitment_type_id' => $request->recruitment_type,
                    'process' => $process,
                    'start_date'=>Carbon::parse($start_date[$key])->toDateString(),
                    'end_date'=>Carbon::parse($end_date[$key])->toDateString(),
                    'created_at'=>$now,
                    'updated_at'=>$now
                ];
        }
       $this->processx->insert($data);
        return redirect()->route('recruitment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process_ids = RecruitmentProcess::where('recruitment_type_id',$id)->get()
            ->map(function ($value)
            {
                return $value->id;
            })->toArray();
        RecruitmentProcess::destroy($process_ids);
        $this->recruitmenttype->findorfail($id)->delete();
        return redirect()->route('recruitment.index');
    }
}
