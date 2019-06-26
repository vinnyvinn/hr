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
                Appraisal Templates
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                        <div class="box box-success">
                        <div class="box-header">
                        <h3 class="box-title">Appraisals</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                   <th>#</th>
                                   <th>Template Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @if(count($templates))
                                @foreach($templates as $template)
                                       <tr>
                                        <td>{{ $template['id'] }}</td>
                                        <td>{{$template['template']}}</td>
                                        <td>{{$template['Department']}}</td>
                                        <td>{{$template['Designation']}}</td>
                                        <td>

                                             @if($template['status'] ==\App\AppraisalProcess::STATUS_PENDING)
                                                <span class="label label-warning"> {{$template['status']}}</span>
                                            @elseif($template['status'] ==\App\AppraisalProcess::STATUS_REJECTED)
                                                <span class="label label-default"> {{$template['status']}}</span>
                                            @elseif($template['status'] ==\App\AppraisalProcess::STATUS_ACCEPTED)
                                                <span class="label label-info"> {{$template['status']}}</span>
                                            @else
                                                <span class="label label-success"> {{$template['status']}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!\App\AppraisalProcess::where('template_id',$template['id'])->where('user_id',Auth::id())->first())
                                           <a href="{{url('processing/'.$template['id'])}}" class="btn btn-success btn-sm"><i class="fa fa-check">Initiate</i></a>
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
