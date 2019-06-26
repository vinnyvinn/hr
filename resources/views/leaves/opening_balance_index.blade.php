@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Opening Balances
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                        <a href="{{ asset('/leave-balance/create') }}" type="button" class="btn btn-success btn-flat margin">New Opening Balance</a>

                    <div class="box box-success">

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-responsive table-bordered balance dataTable" id="balance">
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Year</th>
                                    <th>Opening Balance</th>
                                    <th>Leaves Balance</th>
                                    <th>Action</th>

                                </tr>
                                @foreach($staff as $empl)
                                    <tr>

                                        <td>{{ $empl->user_id}}</td>
                                        <td>{{ $empl->staff->first_name .' '.$empl->staff->last_name }}</td>
                                        <td>{{ $empl->leave_type->leave_type}}</td>
                                        <td>{{ $empl->year }}</td>
                                        <td>{{ $empl->opening_balance }}</td>
                                        <td>
                                            <?php $days = \App\LeaveDay::where('user_id',$empl->user_id)->where('leave_type_id',$empl->leave_type_id)->first()?>
                                            {{$days ? ($days->remaining_leaves+$empl->opening_balance) : (0+$empl->opening_balance)}} </td>

                                        <td>
                                            <a href="{{url('leave-balance/'.$empl->id.'/edit')}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                                            <a href="{{url('delete/leave-balance/'.$empl->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
