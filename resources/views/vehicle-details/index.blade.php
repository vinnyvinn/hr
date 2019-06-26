@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Vehicles Details
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    @if(Auth::user()->role->role_permission('create_leaves'))
                        <a href="{{ asset('/vehicle-details/create') }}" type="button" class="btn btn-success btn-flat margin">New Vehicle Detail</a>
                    @endif
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Vehicle Details List</h3>
                            <div class="box-tools">
                                {!! Form::open(['url' => '/leaves/search', 'method' => 'get']) !!}
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    {!! Form::text('term', null, ['class' => 'form-control pull-right', 'placeholder' => 'Search']) !!}
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>Number</th>
                                    <th>Model</th>
                                    <th>Description</th>
                                    <th>Purchase date</th>
                                    @if(Auth::user()->role->role_permission('edit_leaves') || Auth::user()->role->role_permission('delete_leaves'))
                                        <th class="">Action</th>
                                    @endif
                                </tr>
                                @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td >
                                            @if(Auth::user()->role->role_permission('view_users'))
                                                <a href="#">
                                                    {{ ucwords($vehicle->user->first_name)}} {{ucwords($vehicle->user->last_name)}}</a>
                                            @else
                                                {{ ucwords($vehicle->user->first_name)}} {{ucwords($vehicle->user->last_name)}}
                                            @endif
                                        </td>
                                        <td>{{ $vehicle->vehicle_type }}</td>
                                        <td>{{ $vehicle->vehicle_number }}</td>
                                        <td>{{ $vehicle->vehicle_model }}</td>
                                        <td>{{ $vehicle->vehicle_description }}</td>
                                        <td>{{ $vehicle->vehicle_purchase_date }}</td>
                                        @if(Auth::user()->role->role_permission('edit_leaves') || Auth::user()->role->role_permission('process_leave'))
                                            <td class="">
                                                <div class="btn-group">
                                                    @if(Auth::user()->role->role_permission('edit_leaves') )
                                                        <a href="{{ asset('vehicle-details/'.$vehicle->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
                                                    @endif
                                                    @if(Auth::user()->role->role_permission('delete_leaves') )
                                                        <a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $vehicle->id }}"><i class="fa fa-trash"></i></a>
                                                        <div id="deleteModal{{ $vehicle->id }}" class="modal fade" role="dialog">
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
                                                                        {!! Form::open(['url' => ['vehicle-details/'.$vehicle->id], 'method' => 'delete']) !!}
                                                                        {!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
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
