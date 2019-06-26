<?php

namespace App\Http\Controllers;

use App\Training;
use App\TrainingType;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class TrainingController extends Controller
{
    protected $trainingtype;
    protected $training;

    /**
     * RecruitmentController constructor.
     * @param $trainingtype
     * @param $training
     */
    public function __construct(TrainingType $trainingtype,Training $training)
    {
        $this->trainingtype = $trainingtype;
        $this->training = $training;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->trainingtype->with('training')->get()
            ->map(function($value)
            {
                if($value->training->count() > 0)
                {
                    return $value;
                }
            })->reject(null);
        return view('trainings.index')
            ->withTrainings($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainings.create')
            ->withTrainingtypes($this->trainingtype->all()->sortBy('name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $now = Carbon::now();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = [];
        foreach ($request->description as $key => $description)
        {
            $data[] =
                [
                    'training_type_id' => $request->training_type,
                    'description' => $description,
                    'start_date'=>Carbon::parse($start_date[$key])->toDateString(),
                    'end_date'=>Carbon::parse($end_date[$key])->toDateString(),
                    'created_at'=>$now,
                    'updated_at'=>$now
                ];
        }
        Training::insert($data);
        return redirect()->route('trainings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->trainingtype->with('training')
            ->where('id',$id)->get()->map(function($value)
            {
                return
                    [
                        'name' => $value->name,
                        'desc' => $value->description,
                        'description' => $value->training->sortBy('id')->toArray()
                    ];
            });

        return view('trainings.show')
            ->withTrainingdetail($data->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('trainings.edit')
            ->with('typeid',$id)
            ->with('trainings',Training::where('training_type_id',$id)->get())
            ->withTrainingtypes($this->trainingtype->all()->sortBy('name')
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
        $training_ids = $this->training->where('training_type_id',$id)->get()
            ->map(function ($value)
            {
                return $value->id;
            })->toArray();
        $this->training->destroy($training_ids);

        $now = Carbon::now();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = [];
        foreach ($request->description as $key => $description)
        {
            $data[] =
                [
                    'training_type_id' => $request->training_type,
                    'description' => $description,
                    'start_date'=>Carbon::parse($start_date[$key])->toDateString(),
                    'end_date'=>Carbon::parse($end_date[$key])->toDateString(),
                    'created_at'=>$now,
                    'updated_at'=>$now
                ];
        }

        $this->training->insert($data);
        return redirect()->route('trainings.index');
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
