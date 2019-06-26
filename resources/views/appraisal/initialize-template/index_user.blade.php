@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Perform Appraisals
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')

                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Active Appraisals </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Template Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Date Initialized</th>
                                    <th>Action</th>

                                </tr>
                                <?php $i = 1; ?>
                                @foreach($items_found as $active)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            @foreach($questionares as $questionare)
                                                @if($questionare->id == $active->appraisalquestionare_id)
                                                    {{$questionare->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <?php $quest = App\AppraisalQuestionare::findorFail($active->appraisalquestionare_id);
                                            $dept_id = $quest->department_id; ?>


                                            @foreach($departments as $department)
                                                @if($department->id == $dept_id)
                                                    {{$department->department}}
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>
                                            <?php $quest = App\AppraisalQuestionare::findorFail($active->appraisalquestionare_id);
                                            $desig_id = $quest->designation_id; ?>


                                            @foreach($designations as $designation)
                                                @if($designation->id == $desig_id)
                                                    {{$designation->designation_item}}
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>{{ $active->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                       <a href="{{url('user-perform-appraisal/'.$active->id)}}" title="Perform" class="btn btn-default btn-flat btn-sm"><i class="fa fa-eye"></i></a>
                                              </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
