@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <!-- Include Editor style. -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
    <style>
        [hidden] {
            display: none !important;
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
                            <p>Issued Date: <b>{{date('d/m/Y',strtotime($appraisal->updated_at))}}</b></p>
                            <p>Department: <b>{{Auth::user()->department->department}}</b></p>
                            <p>Designation: <b>{{Auth::user()->designation_item->designation_item}}</b></p>
                            <p>Name: <b>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</b></p>
                            <p>Join Date: <b>{{Auth::user()->date_hired}}</b></p>
                        </div>
                        </div>
                        </div>
                       <div class="box-body">
                            <form action="{{route('processing.store')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$appraisal->id}}">
                                <input type="hidden" name="issue_date" value="{{date('d/m/Y',strtotime($appraisal->updated_at))}}">
                                <?php $number=1?>
                                @foreach($types as $t)
                                       @if($t->type_value ==\App\QuestionType::NUMERIC)
                                        <div class="form-group">
                                            <label for="q1"> {{$number++ .'. '.$t->name}}</label>
                                            <input type="hidden" name="qe1[]" value="{{$t->name}}">
                                            <input type="number" name="q1[]" class="form-control" name="q1" required>
                                            <br>

                                        </div>
                                     @elseif($t->type_value ==\App\QuestionType::TEXT)
                                        <div class="form-group">
                                            <label for="q2">{{$number++ .'. '.$t->name}}</label>
                                            <input type="hidden" name="qe2[]" value="{{$t->name}}">
                                            <textarea name="q2[]" cols="5" rows="3" class="form-control summernote" required></textarea>
                                            <br>

                                        </div>
                                    @elseif($t->type_value ==\App\QuestionType::STARS)
                                        <div class="form-group">
                                            <label for="q3">{{$number++ .'. '.$t->name}}</label>
                                            <input type="hidden" name="qe3[]" value="{{$t->name}}">
                                            <input type="number" name="q3[]" class="form-control" required>
                                            <br>

                                        </div>
                                    @elseif($t->type_value ==\App\QuestionType::TRUE_FALSE)
                                        <div class="form-group">
                                            <h5><b>{{$number++ .'. '.$t->name}}</b></h5>
                                            <label>
                                                <input type="hidden" name="q4[]" value="{{$t->name}}">
                                                <input id="optradio" type="radio" name="optradio[{{$t->id}}]"
                                                       value="true">
                                                    True
                                                <input id="optradio" type="radio" name="optradio[{{$t->id}}]"
                                                       value="false" style="margin-left: 20px">
                                                    False
                                            </label>
                                            <br>
                                        </div>
                                    @endif
                                    @endforeach

                                <div class="form-group">
                                    <a href="{{url('/appraisal-master')}}" class="btn btn-default">Clear</a>
                                    <input type="submit" name="submit" class="btn btn-danger" value="Cancel">
                                    <input type="submit" name="submit" value="Save" class="btn btn-success">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-warning">

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

        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 150
            });
        });
        $('.select2').select2();

    </script>

@endsection

