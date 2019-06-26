@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1 class="text-center">
                Create Appraisal Template
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Appraisal Template</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('template-app.update',['id' => $template->id ])}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required value="{{$template->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="quetions">Questions</label>
                                    <select name="questions[]" id="questions" class="form-control select2 questions" multiple required>
                                        @foreach($questions as $question)
                                            @foreach(json_decode($template->questions) as $q)
                                            <option value="{{$question->id}}" @if($q->keyVal == $question->id) selected='selected' @endif>{{$question->name}}</option>
                                                @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('foot')
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>

    <script>
        $('.select2').select2();


    </script>

@endsection