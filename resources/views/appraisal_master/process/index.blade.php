@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <style>

        .select2-container--default{
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Appraisals
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')

                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Appraisals</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Template Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @if(count($appraisals))
                                    @foreach($appraisals as $appraisal)
                                        <tr>
                                            <td>{{ $appraisal['id'] }}</td>
                                            <td>{{$appraisal['employee']}}</td>
                                            <td>{{$appraisal['template']}}</td>
                                            <td>{{$appraisal['Department']}}</td>
                                            <td>{{$appraisal['Designation']}}</td>
                                            <td>
                                                @if($appraisal['status'] ==\App\AppraisalProcess::STATUS_PENDING)
                                                    <span class="label label-warning"> {{$appraisal['status']}}</span>
                                                @elseif($appraisal['status'] ==\App\AppraisalProcess::STATUS_REJECTED)
                                                    <span class="label label-default"> {{$appraisal['status']}}</span>
                                                @elseif($appraisal['status'] ==\App\AppraisalProcess::STATUS_ACCEPTED)
                                                    <span class="label label-info"> {{$appraisal['status']}}</span>
                                                @else
                                                    <span class="label label-success"> {{$appraisal['status']}}</span>
                                                @endif
                                            </td>
                                            <td>
                                               @if($appraisal['status'] == \App\AppraisalProcess::STATUS_PENDING || $appraisal['status'] ==\App\AppraisalMaster::STATUS_WIP || $appraisal['status'] ==\App\AppraisalMaster::STATUS_COMPLETE)
                                           <a href="{{url('processing/'.$appraisal['id'].'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-eye">Approve</i></a>
                                                    @elseif($appraisal['status'] == \App\AppraisalProcess::STATUS_APPROVED)
                                                    <a href="{{url('finalize-appraisal/'.$appraisal['id'])}}" class="btn btn-primary btn-sm"><i class="fa fa-eye">Finalize</i></a>
                                                   @elseif($appraisal['status'] == \App\AppraisalProcess::STATUS_ACCEPTED)
                                                    <a href="{{url('show-appraisal/'.$appraisal['id'])}}" class="btn btn-info btn-sm"><i class="fa fa-eye">Show</i></a>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
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
        jQuery(function($) {



            //initiate dataTables plugin
            var myTable =
                $('.dataTable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable( {
                        bAutoWidth: false,
                        "aoColumns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null

                        ],
                        "aaSorting": [],

                        select: {
                            style: 'multi'
                        }
                    });
        });


    </script>

@endsection
