@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Termination
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    @if(Auth::user()->role->role_permission('create_attendances'))
                        <a href="{{ asset('/termination/create') }}" type="button" class="btn btn-success btn-flat margin">New Termination Template</a>
                    @endif
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Termination Template List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>Recruitment type</th>
                                    <th>Description</th>
                                    @if(Auth::user()->role->role_permission('edit_attendances') || Auth::user()->role->role_permission('delete_attendances'))
                                        <th class="pull-right">Action</th>
                                    @endif
                                </tr>
                                @foreach($recruits as $recruit)
                                    <tr>
                                        <td><a href="{{route('recruitment.show',$recruit->id)}}">{{$recruit->name }}</a></td>
                                        <td>{{ $recruit->description }}</td>
                                        @if(Auth::user()->role->role_permission('edit_attendances') || Auth::user()->role->role_permission('delete_attendances'))
                                            <td class="pull-right">
                                                <div class="btn-group">
                                                    @if(Auth::user()->role->role_permission('edit_attendances'))
                                                        <a href="{{ asset('recruitment/'.$recruit->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
                                                    @endif
                                                    @if(Auth::user()->role->role_permission('delete_attendances'))
                                                        <a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $recruit->id }}"><i class="fa fa-trash"></i></a>
                                                        <div id="deleteModal{{ $recruit->id }}" class="modal fade" role="dialog">
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
                                                                        {!! Form::open(['url' => ['recruitment/'.$recruit->id], 'method' => 'delete']) !!}
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
                        <div class="box-footer clearfix">
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--Showing {{ $recruits->firstItem() }} to {{ $recruits->lastItem() }} of {{ $recruits->total() }} entries--}}
                                    {{--<div class="pull-right">--}}
                                        {{--{!! $recruits->links() !!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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
