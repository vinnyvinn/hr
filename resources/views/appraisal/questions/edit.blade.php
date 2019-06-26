@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1 class="text-center">
                Modify Appraisal Questions Type
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Edit Appraisal Questions Type</h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                <form  action="{{ url('quiz/updated',$appr->id) }}">

                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <input type="hidden" value="{{$appr->id}}" name="id">
                                    <div class="form-group">
                                        <label for="name">Question</label>
                                        <input required autofocus type="text" class="form-control" id="question" name="question" value="{{$appr->question}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="question_type_id">Question type</label>
                                        <select class="form-control" name="question_type_id">
                                            @foreach($question_types as $type)
                                                <option value="{{$type->id}}"  {{ $appr->question_type_id == $type->id ? 'selected="selected"' : '' }}>{{$type->name}}</option>

                                            @endforeach

                                        </select>
                                    </div>

                                        <div class="form-group">
                                        <input class="btn btn-primary pull-right" type="submit">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
