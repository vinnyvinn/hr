@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <!-- Include Editor style. -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
    <style>
        [hidden] {
            display: none !important;
        }
        /*.checkbox label:after {*/
        /*    content: '';*/
        /*    display: table;*/
        /*    clear: both;*/
        /*}*/

        /*.checkbox .cr {*/
        /*    position: relative;*/
        /*    display: inline-block;*/
        /*    border: 1px solid #a9a9a9;*/
        /*    border-radius: .25em;*/
        /*    width: 1.3em;*/
        /*    height: 1.3em;*/
        /*    float: left;*/
        /*    margin-right: .5em;*/
        /*}*/

        /*.checkbox .cr .cr-icon {*/
        /*    position: absolute;*/
        /*    font-size: .8em;*/
        /*    line-height: 0;*/
        /*    top: 50%;*/
        /*    left: 15%;*/
        /*}*/

        /*.checkbox label input[type="checkbox"] {*/
        /*    display: none;*/
        /*}*/

        /*.checkbox label input[type="checkbox"]+.cr>.cr-icon {*/
        /*    opacity: 0;*/
        /*}*/

        /*.checkbox label input[type="checkbox"]:checked+.cr>.cr-icon {*/
        /*    opacity: 1;*/
        /*}*/

        /*.checkbox label input[type="checkbox"]:disabled+.cr {*/
        /*    opacity: .5;*/
        /*}*/
        /*.pull-right{*/
        /*    margin-top: -28px !important;*/
        /*    */
        /*}*/
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
                            <form action="{{url('update-appraisal')}}" method="POST">
                                {{csrf_field()}}

                                <input type="hidden" name="id" value="{{$process->id}}">
                                <input type="hidden" name="issue_date"
                                       value="{{date('d/m/Y',strtotime($process->issue_date))}}">
                            <?php $number = 1;
                                $incr = 1;
                                $q = 1;
                                ?>
                                @foreach(json_decode($process->answers) as $key =>$p)
                                    @if($p->question_type =='numeric')
                                        <div class="form-group">
                                            <label for="q1"> {{$number++ .'. '.$p->question}}</label>
                                            <input type="hidden" name="qe1[]" value="{{$p->question}}">
                                                              <input type="number" name="q1[]" class="form-control"
                                                   value="{{$p->answer}}">

                                        </div>
                                    @elseif($p->question_type =='text')
                                        <div class="form-group">
                                            <label for="q2">{{$number++ .'. '.$p->question}}</label>
                                            <input type="hidden" name="qe2[]" value="{{$p->question}}">

                                            <textarea cols="5" rows="3" class="form-control"
                                                      name="q2[]">{{strip_tags($p->answer)}}</textarea>

                                        </div>
                                    @elseif($p->question_type =='stars')
                                        <div class="form-group">
                                            <label for="q3">{{$number++ .'. '.$p->question}}</label>
                                            <input type="hidden" name="qe3[]" value="{{$p->question}}">
                                                             <input type="number" name="q3[]" class="form-control"
                                                   value="{{$p->answer}}" >

                                        </div>
                                    @elseif($p->question_type =='true_false')
                                        <div class="form-group">
                                            <h5><b>{{$number++ .'. '.$p->question}}</b></h5>
                                            <label>
                                                <input type="hidden" name="qe4[]" value="{{$p->question}}">
                                                  <input id="optradio" type="radio" name="optradio[{{$incr++}}]"
                                                           value="true" {{$p->answer == 'true' ? 'checked' : ''}} style="margin-left: 20px">
                                                True
                                                <input id="optradio" type="radio" name="optradio[{{$incr++}}]"
                                                       value="false" {{$p->answer == 'false' ? 'checked' : ''}} style="margin-left: 20px">
                                                False
                                            </label>

                                        </div>
                                    @endif
                                @endforeach
                                <div class="form-group">
                                    <a href="{{url('/appraisal-master')}}" class="btn btn-default">Clear</a>
                                    <a href="{{url('/appraisal-master')}}" class="btn btn-danger">Cancel</a>
                                    <input type="submit" value="Save" class="btn btn-success">
                                    <a href="{{url('/appraisal-master')}}" class="btn btn-warning">Submit</a>

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
            $('.vk').on('click',function () {
                console.log($(this).val());
            })
            $('.check_t').on('click',function () {
                console.log($(this).val());
            })

            $('.clean').on('change',function () {
                // var x = $(".walla2").attr('cool');
                // // console.log(x);

                var userCheckbox = $(".walla2:checked").map(function() {
                    return $(this).attr('cool');
                }).get();

                var userCheckbox = $(".walla2:checked").map(function() {
                    return $(this).attr('cool');
                }).get();

                var selectedArr = [];
                var dataElem = $('#data');
                $('.walla2').on('change', function() {
                    if (this.checked) {
                        selectedArr.push($(this).attr('cool'));
                    } else {
                        selectedArr.splice(selectedArr.indexOf($(this).attr('cool')), 1);
                    }

                    console.log(JSON.stringify(selectedArr));
                });


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

