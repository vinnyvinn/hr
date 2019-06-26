@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <!-- Include Editor style. -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
    <style>
        [hidden] {
            display: none !important;
        }
        label {
            display: block !important;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Appraisal Processing
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Appraisal Processing </h3>
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <p></p>
                                    <p>Issued Date: <b>{{date('d/m/Y',strtotime($process->issue_date))}}</b></p>
                                    <p>Department: <b>{{$process->user->department->department}}</b></p>
                                    <p>Designation: <b>{{$process->user->designation_item->designation_item}}</b></p>
                                    <p>Name: <b>{{$process->user->first_name.' '.$process->user->last_name}}</b></p>
                                    <p>Join Date: <b>{{$process->user->date_hired}}</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <form action="{{url('final-update/'.$process->id)}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$process->id}}">
                                <input type="hidden" name="issue_date"
                                       value="{{date('d/m/Y',strtotime($process->issue_date))}}">
                                <?php $number = 1;
                                $incr = 1;
                                $q = 1;
                                ?>

                               @if($process->evaluator_response)
                                @foreach(json_decode($process->evaluator_response) as $p)

                                    @if($p->question_type =='numeric')
                                        <div class="form-group">
                                            <label for="q1"> {{$number++ .'. '.$p->question}}</label>
                                            <input type="hidden" name="qe1[]" value="{{$p->question}}">
                                            <input type="number" name="q1[]" class="form-control"
                                                   value="{{$p->answer}}" readonly>
                                            <br>
                                            <h4>Evaluator's Response</h4>
                                            <textarea name="res1[]" cols="5" rows="3" class="form-control"
                                                      readonly>{{strip_tags($p->response)}}</textarea>
                                            <br>
                                            <div class="form-group" style="display: none">
                                                <div class="row">
                                                    <div class="col-lg-6 col-lg-offset-4" style="display: inline-flex">
                                                        <label class="radioo">I accept
                                                            <input type="radio" name="a1[{{$p->keyVal}}]" value="true"
                                                                   checked>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="radioo" style="margin-left: 100px">I do not accept
                                                            <input type="radio" name="a1[{{$p->keyVal}}]" value="false">
                                                            <span class="checkmark"></span>
                                                       </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @elseif($p->question_type =='text')
                                        <div class="form-group">
                                            <label for="q2">{{$number++ .'. '.$p->question}}</label>
                                            <input type="hidden" name="qe2[]" value="{{$p->question}}">
                                            <input type="hidden" name="q2[]" value="{{$p->answer}}">
                                            <textarea cols="5" rows="3" class="form-control"
                                                      readonly>{{strip_tags($p->answer)}}</textarea>
                                            <br>
                                            <h4>Evaluator's Response</h4>
                                            <textarea name="res2[]" cols="5" rows="3" class="form-control"
                                                      readonly>{{strip_tags($p->response)}}</textarea>
                                            <br>
                                            <div class="form-group" style="display: none">
                                                <div class="row">
                                                    <div class="col-lg-6 col-lg-offset-4" style="display: inline-flex">
                                                        <label class="radioo">I accept
                                                            <input type="radio" name="a2[{{$p->keyVal}}]" value="true"
                                                                   checked>
                                                            <span class="checkmark"></span>
                                                        </label>


                                                        <label class="radioo" style="margin-left: 100px">I do not accept
                                                            <input type="radio" name="a2[{{$p->keyVal}}]" value="false">
                                                            <span class="checkmark"></span>
                                                        </label>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @elseif($p->question_type =='stars')
                                        <div class="form-group">
                                            <label for="q3">{{$number++ .'. '.$p->question}}</label>
                                            <input type="hidden" name="qe3[]" value="{{$p->question}}">
                                            <input type="number" name="q3[]" class="form-control"
                                                   value="{{$p->answer}}" readonly>
                                            <br>
                                            <h4>Evaluator's Response</h4>
                                            <textarea name="res3[]" cols="5" rows="3" class="form-control"
                                                      readonly>{{strip_tags($p->response)}}</textarea>
                                            <br>
                                            <div class="form-group" style="display: none">
                                                <div class="row">
                                                    <div class="col-lg-6 col-lg-offset-4" style="display: inline-flex">
                                                        <label class="radioo">I accept
                                                            <input type="radio" name="a3[{{$p->keyVal}}]" value="true"
                                                                   checked>
                                                            <span class="checkmark"></span>
                                                        </label>


                                                        <label class="radioo" style="margin-left: 100px">I do not accept
                                                            <input type="radio" name="a3[{{$p->keyVal}}]" value="false">
                                                            <span class="checkmark"></span>
                                                        </label>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @elseif($p->question_type =='true_false')
                                        <?php $v = 1?>
                                        <div class="form-group">
                                            <h5><b>{{$number++ .'. '.$p->question}}</b></h5>
                                            <label>
                                                <input type="hidden" name="q4[]" value="{{$p->question}}">
                                                <input id="walla" type="radio" name="walla[{{$incr++}}]"
                                                       value="true" {{$p->answer == 'true' ? 'checked' : ''}} disabled>
                                                True

                                                <input id="walla" type="radio" name="walla[{{$incr++}}]"
                                                       value="false"
                                                       {{$p->answer == 'false' ? 'checked' : ''}} style="margin-left: 20px"
                                                       disabled>
                                                False
                                                <span style="display: none">
                                                    <input id="optradio" type="radio" name="optradio[{{$incr++}}]"
                                                           value="true"
                                                           {{$p->answer == 'true' ? 'checked' : ''}} style="margin-left: 20px">
                                                True
                                                <input id="optradio" type="radio" name="optradio[{{$incr++}}]"
                                                       value="false"
                                                       {{$p->answer == 'false' ? 'checked' : ''}} style="margin-left: 20px">
                                                False
                                                </span>

                                                <br>
                                                <label>Evaluator's Response</label>
                                                <textarea name="res3[]" cols="5" rows="3" class="form-control"
                                                          readonly>{{strip_tags($p->response)}}</textarea>
                                            </label>
                                            <br>
                                            <div class="form-group" style="display: none">
                                                <div class="row">
                                                    <div class="col-lg-6 col-lg-offset-4" style="display: inline-flex">
                                                        <label class="radioo">I accept
                                                            <input type="radio" name="a4[{{$p->keyVal}}]" value="true"
                                                                   checked>
                                                            <span class="checkmark"></span>
                                                        </label>

                                                        <label class="radioo" style="margin-left: 100px">I do not accept
                                                            <input type="radio" name="a4[{{$p->keyVal}}]" value="false">
                                                            <span class="checkmark"></span>
                                                        </label>


                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    @endif

                                @endforeach
                                @endif


                                <div class="form-group">
                                    <a href="{{url('/processing')}}" class="btn btn-default">Clear</a>
                                    <a href="{{url('/reject-appraisal/'.$process->id)}}" class="btn btn-danger">Reject</a>
                                     <a href="{{url('/approve-appraisal/'.$process->id)}}" class="btn btn-success">Accept</a>

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
    <script src="{{asset('/dist/js/summernote-bs4.js')}}"></script>

    <script>

        $(function () {
            $('.a2').on('click', function () {
                console.log($(this).val());


            })
        })
        $(document).ready(function () {
            $('.summernote').summernote({
                tabsize: 2,
                height: 150
            });
        });
        $('.select2').select2();

    </script>

@endsection

