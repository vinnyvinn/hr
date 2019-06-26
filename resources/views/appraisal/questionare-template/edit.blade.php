@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1 class="text-center">
                Edit Appraisal Template
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Select Questions</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{ url('quiz/update-temp/'.$questionare->id)}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Template Name</label>
                                    <input class="form-control" type="text" name="name" required="true" value="{{$questionare->name}}">
                                </div>

                                @foreach($questions as $question)
                                    <div class="form-group">
                                        <input type="checkbox" value="{{$question->id}}" name="questions[]"
                                      > &nbsp; {{$question->question}}
                                    </div>
                                @endforeach



                                      <div class="form-group">
                                    <label for="department_id">Select a department</label>
                                    <select name="department_id" class="form-control" required="true">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}"  {{ $questionare->department_id == $department->id ? 'selected="selected"' : '' }}>{{$department->department}}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="designation_id">Select a Designation</label>
                                    <select name="designation_id" class="form-control" required="true">
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}"  {{ $designation->id == $questionare->designation_id ? 'selected="selected"' : '' }}>{{$designation->designation_item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success pull-right" type="submit" name="Create">
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
