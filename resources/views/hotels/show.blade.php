@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Room Details
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                     <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Room Types</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>Name</th>
                                    <th>Rate/Day</th>
                                    <th>Currency</th>
                                    </tr>
                                @foreach(json_decode($rooms->room_types) as $room)

                                        <tr>
                                        <td>{{$room->name }}</td>
                                        <td>{{$room->rate}}</td>
                                        <td>{{$room->currency}}</td>
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
                    .DataTable( {
                        bAutoWidth: false,
                        "aoColumns": [
                            null,
                            null,
                            null

                        ],
                        "aaSorting": [],
                    });
        });
    </script>

@endsection
