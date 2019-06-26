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
        <style>
            .col-md-1{
                width: 7.33333333% !important;
            }
        </style>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Appraisal Template </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('appraisal-master.store')}}" method="POST">
                                {{csrf_field()}}
                                   <div class="form-group">
                                   <label for="make">Appraisal Name</label>

                                        <select name="template_id" id="template_id" class="form-control select2" required>
                                            <option></option>
                                            @foreach($templates as $template)
                                                <option value="{{$template->id}}">{{$template->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 25px;margin-left: -25px;display: none">
                                        <a href="#" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o fa-2x" aria-hidden="true" title="Add New"></i></a>
                                    </div>

                                <div class="form-group">
                                    <label for="model">Search Questions</label>
                                    <select name="question_id[]" id="question_id" class="form-control select2 question_id" multiple required>

                                    </select>
                                </div>
                                    <div class="col-md-1" style="margin-top: 25px;margin-left: -25px;display: none">
                                        <a href="#" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#myQuiz"><i class="fa fa-plus-square-o fa-2x" aria-hidden="true" title="Add New"></i></a>
                                    </div>
                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-success">
                                    <a href="{{url('/appraisal-master')}}" class="btn btn-default">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Appraisal Template Form</h4>
                </div>
                <form action="{{route('template-app.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-10 col-md-offset-1">

                                <div class="form-group">
                                    <label for="name">Template Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="myQuiz" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Appraisal Questions Form</h4>
                </div>
                <form action="{{url('question-store')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea name="question" id="question" cols="5" rows="3" placeholder="Type Question..." class="form-control" required></textarea>
                               </div>
                                <div class="form-group">
                                    <label for="question_type_id">Question Type</label>
                                    <select name="question_type_id" id="question_type_id" class="form-control" required>
                                        @foreach($types as $type)
                                         <option value="{{$type->id}}">{{$type->name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('foot')
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>


    <script>
       $('.select2').select2();
       
       $('#template_id').on('change',getQuestions)
        
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

