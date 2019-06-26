@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Travel Plan
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    <a href="{{ url('/travels/create') }}" type="button" class="btn btn-success btn-flat margin">New Travel Plan</a>
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Travel Plan List</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>ID</th>
                                    <th>Staff</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Project</th>
                                    <th>Total Cost</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($travels as $travel)
                                       <tr>
                                        <td>{{$travel->id }}</td>
                                        <td>{{$travel->user->first_name.' '.$travel->last_name}}</td>
                                        <td>{{$travel->start_date}}</td>
                                        <td>{{$travel->end_date}}</td>
                                        <td>{{$travel->project_id}}</td>
                                           <td>{{number_format($travel->total_price,2)}}</td>
                                           <td>
                                               @if($travel->status == \App\TravelPlan::STATUS_APPROVED)
                                                   <span class="label label-success">{{$travel->status}}</span>
                                                   @elseif($travel->status==\App\TravelPlan::STATUS_REJECTED)
                                               <span class="label label-warning">{{$travel->status}}</span>
                                                   @else
                                               <span class="label label-info">{{$travel->status}}</span>
                                                   @endif
                                           </td>
                                        <td>
                                            <a href="{{url('travels/'.$travel->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye">Show details</i></a>
                                            @if($travel->status ==\App\TravelPlan::STATUS_REJECTED || $travel->status ==\App\TravelPlan::STATUS_APPROVED)
                                                @else
                                                @if(Auth::user()->role->layout==1)
                                            <a href="{{url('approve-travel/'.$travel->id)}}" class="btn btn-info btn-xs"><i class="fa fa-check">Approve</i></a>
                                            <a href="{{url('reject-travel/'.$travel->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-times">Reject</i></a>
                                      @endif
                                       @endif
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
                            null,
                            null,
                            null
                        ],
                        "aaSorting": [],
                    });
        });
    </script>

@endsection
