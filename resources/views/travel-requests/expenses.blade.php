@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Travel Request
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    @if(Auth::user()->role->role_permission('create_leaves'))
                        <a href="{{ asset('/travel-perdiem') }}" type="button" class="btn btn-success btn-flat margin">New Travel Request</a>
                    @endif
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Travel Request List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Travel Mode</th>
                                    <th>Fare</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense['employee_id'] }}</td>
                                        <td>
                                            @if(Auth::user()->role->role_permission('view_users'))
                                                <a href="{{asset('/users/'.$expense['user_id'])}}">{{ $expense['first_name'].' '.$expense['last_name']}}</a>
                                            @else
                                                {{ $expense['first_name'].' '.$expense['last_name'] }}
                                            @endif
                                        </td>
                                        <td>{{ $expense['department']}}</td>
                                        <td>{{ $expense['travel_mode'] }}</td>
                                        <td>{{ $expense['fare'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                         <tr>
                                             <th></th>
                                             <th></th>
                                             <th></th>
                                            <th>Total</th>
                                            <th>{{$total}}</th>
                                         </tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="box-footer clearfix">
                            <div class="row">
                                <div class="col-xs-12">
                                    {{--Showing {{ $expenses->firstItem() }} to {{ $expenses->lastItem() }} of {{ $expenses->total() }} entries--}}
                                    {{--<div class="pull-right">--}}
                                    {{--{!! $expenses->links() !!}--}}
                                    {{--</div>--}}
                                </div>
                            </div>
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
