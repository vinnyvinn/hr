@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Questions
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                        <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Questions List</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>ID</th>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                </tr>
                                @foreach(json_decode($template->questions) as $templ)
                                        <tr>
                                        <td>{{ $templ->keyVal }}</td>
                                        <td>{{$templ->question}}</td>
                                        <td>{{$templ->type}}</td>
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
