@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1 class="text-center">
                Modify Question Type
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Edit Question Type</h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                <form method="POST" action="{{ route('quiz.update',$question->id) }}">
                                    <input name="_method" type="hidden" value="PUT">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input required autofocus type="text" class="form-control" id="name" name="name" value="{{$question->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="type_value">Choose an answer type</label> <br>
                                        <input type="radio" name="type_value" value="1" {{ $question->type_value ==1 ? 'checked' : ''}}>Numeric<br>
                                        <input type="radio" name="type_value" value="2" {{ $question->type_value ==2 ? 'checked' : ''}}> Text<br>
                                        <input type="radio" name="type_value" value="3" {{ $question->type_value ==3 ? 'checked' : ''}}> Stars <br>
                                        <input type="radio" name="type_value" value="4" {{ $question->type_value ==4 ? 'checked' : ''}}> True /False <br>
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
