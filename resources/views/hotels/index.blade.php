@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Hotels
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    <a href="{{ url('/hotels/create') }}" type="button" class="btn btn-success btn-flat margin">New Hotel</a>

                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Hotels List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($hotels as $hotel)
                                    <tr>
                                        <td>{{$hotel->id }}</td>
                                        <td>{{$hotel->name}}</td>
                                        <td>{{$hotel->address}}</td>
                                        <td>{{$hotel->country}}</td>
                                        <td>{{$hotel->city}}</td>
                                        <td>
                                            <a href="{{url('hotels/'.$hotel->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye">Room details</i></a>
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
                    });
        });
    </script>

@endsection
