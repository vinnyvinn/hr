@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Hierachy
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    <a href="{{ url('/hierachy/create') }}" type="button" class="btn btn-success btn-flat margin">New Hierachy</a>

                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Hierachy List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>ID</th>
                                    <th>Staff</th>
                                    <th>Supervisor / TeamLead</th>
                                    <th>Manager</th>
                                    <th>Sub-ordinate(s)</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($details as $detail)
                                         <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{$detail->staff->first_name .' '.$detail->staff->last_name}}</td>
                                        <td>{{$detail->supervisor->first_name .' '.$detail->supervisor->last_name}}</td>
                                        <td>{{$detail->manager->first_name .' '.$detail->manager->last_name}}</td>
                                        <td>
                                            @if(count($detail->users))
                                            <table class="table table-responsive no-border">
                                                <tr>
                                                    @foreach($detail->users as $empl)
                                                        <td class="list-group-item">{{$empl->first_name .' '.$empl->last_name}}</td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                                @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ asset('hierachy/'.$detail->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $detail->id }}"><i class="fa fa-trash"></i></a>
                                                <div id="deleteModal{{ $detail ->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Confirm Delete</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this item?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                                                                {!! Form::open(['url' => ['hierachy/'.$detail->id], 'method' => 'delete']) !!}
                                                                {!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('foot')
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
                            null

                        ],
                        "aaSorting": [],
                        //"bProcessing": true,
                        //"bServerSide": true,
                        //"sAjaxSource": "http://127.0.0.1/table.php"   ,
                        //,
                        //"sScrollY": "200px",
                        //"bPaginate": false,
                        //"sScrollX": "100%",
                        //"sScrollXInner": "120%",
                        //"bScrollCollapse": true,
                        //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                        //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                        //"iDisplayLength": 50
                        select: {
                            style: 'multi'
                        }
                    });
        });
    </script>

@endsection
