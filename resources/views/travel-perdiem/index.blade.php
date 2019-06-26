@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Travel Perdiem
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    @if(Auth::user()->role->role_permission('create_attendances'))
                        <a href="{{ asset('/travel-perdiem/create') }}" type="button" class="btn btn-success btn-flat margin">New Travel Perdiem</a>
                    @endif
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Travel Perdiem List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>Department</th>
                                    <th>Description</th>
                                    @if(Auth::user()->role->role_permission('edit_attendances') || Auth::user()->role->role_permission('delete_attendances'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                                @foreach($departments as $key => $department)
                                    
                                    <tr>
                                        <td>{{ $department['department']}}</td>
                                        <td>{{$department['description']}}</td>
                                        @if(Auth::user()->role->role_permission('edit_attendances') || Auth::user()->role->role_permission('delete_attendances'))
                                            <td>
                                                <div class="btn-group">
                                                        <a href="{{ asset('travel-perdiem/'.$key) }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
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
