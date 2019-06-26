@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Contracts
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    <a href="{{ url('/contracts/create') }}" type="button" class="btn btn-success btn-flat margin">New Contract</a>
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Contracts List</h3>
                        </div>
                        <div class="box-body">
                            <table id="example" class="table table-striped table-responsive table-bordered dataTable" style="width: 100%">
                                <tr>
                                    <th>ID</th>
                                    <th>Staff</th>
                                    <th>Contract Profile</th>
                                    <th>Contract Expiry Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($contracts as $contract)
                                    <tr>
                                        <td>{{ $contract->id }}</td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach($contract->users as $user)
                                                    <li class="list-group-item">
                                                        {{$user->first_name .' '.$user->last_name}}
                                                    </li>
                                                    @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$contract->template->name}}</td>
                                        <td>{{ $contract->expiry_date }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ asset('contracts/'.$contract->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $contract->id }}"><i class="fa fa-trash"></i></a>
                                                <div id="deleteModal{{ $contract->id }}" class="modal fade" role="dialog">
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
                                                                {!! Form::open(['url' => ['contracts/'.$contract->id], 'method' => 'delete']) !!}
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
