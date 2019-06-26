@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Appraisal Template
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Edit Appraisal Template </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('appraisal-master.update',['id' =>$template->id ])}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                        <div class="form-group">
                                            <label for="make">Appraisal Name</label>

                                            <select name="template_id" id="template_id" class="form-control select2" required>
                                                @foreach($templates as $temp)
                                                    <option value="{{$temp->id}}"@if($temp->id==$template->template_id) selected='selected' @endif >{{$temp->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="model">Search Questions</label>
                                            <select name="question_id[]" id="question_id" class="form-control select2 question_id" multiple required>
                                                @foreach($questions as $quiz)
                                                    @foreach(json_decode($template->question_id) as $tm)
                                                    <option value="{{$quiz->id}}"@if($quiz->id==$tm) selected='selected' @endif >{{$quiz->name}}</option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-success">
                                    <a href="{{url('/appraisal-master')}}" class="btn btn-default">Cancel</a>
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

        $('#template_id').on('change',getQuestions);

        function getQuestions() {
            $.ajax({
                url:'{{url('get-questions')}}'+'/'+$(this).val(),
                type:'GET',
                success: function (response) {
                    $('.question_id').empty();
                    $.each(response,function (key,value) {
                        $('.question_id').append("<option value='"+value.keyVal+"'>"+value.question+"</option>");
                    })
                }
            })
        }
    </script>
@endsection

