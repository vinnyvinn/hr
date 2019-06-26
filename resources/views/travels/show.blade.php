@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
               <section class="content">
            <div class="row">
                <div class="col-md-6">
                          <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Itinerary</h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-hover dataTable">
                                <tr>

                                    <th>From</th>
                                    <th>To</th>
                                    <th>Fare</th>
                                    <th>Mode</th>
                                </tr>
                                @foreach(json_decode($travel->routes) as $r)
                                    <tr>
                                      <td>{{$r->from}}</td>
                                        <td>{{$r->to}}</td>
                                        <td>{{number_format($r->fare,2)}}</td>
                                        <td>{{$r->mode}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Acomodation Details</h3>

                        </div>
                        @if(count(json_decode($travel->accomodation)))
                        <div class="box-body no-padding">
                            <table class="table table-hover wh">
                                <tr>
                                    <th>Hotel</th>
                                    <th>Room Type</th>
                                    <th>Price</th>
                                </tr>
                                @foreach(json_decode($travel->accomodation) as $a)
                                <tr>
                                        <td>{{$a->hotel}}</td>
                                        <td>{{$a->room}}</td>
                                        <td>{{number_format($a->price,2)}}</td>
                                        @endforeach
                                     </tr>
                                    @endif
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
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable =
                $('.wh')
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
