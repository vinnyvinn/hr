@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Leaves Calendar
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                          <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Staff Leave Calendar</h3>
                             </div>
                        <div class="box-body table-responsive no-padding table-bordered table-striped leave-calendar">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Name</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>No. of Leaves</th>
                                    <th>Balance Leaves</th>
                                    <th>Back-Stopping(Y/N)</th>
                                    <th>BackStopped By</th>
                                </tr>
                                @foreach($leaves as $leave)

                                    <tr>
                                        <td>{{ $leave->user->id }}</td>
                                        <td>{{ $leave->user->first_name.' '.$leave->user->last_name}}</td>
                                        <td>{{ $leave->leave_type->leave_type}}</td>
                                        <td>{{ $leave->date_from }}</td>
                                        <td>{{ $leave->date_to}}</td>
                                        <td>{{ $leave->leave_no }}</td>
                                        <td>{{$leave->remaining_days}}</td>
                                        <td>{{$leave->leave_type->backstopper_id ==1 ? 'Y' : 'N'}}</td>
                                        <td>{{$leave->staff ? $leave->staff->first_name .' '. $leave->staff->last_name : ''}}</td>
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
