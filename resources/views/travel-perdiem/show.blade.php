


@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Travel Perdiem
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                                <a href="{{url('/travel-perdiem')}}" class="pull-left btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i></a>
                            <div class="col-md-8 ">
                                <h3 class="box-title"><strong>Department:</strong> {{$department}} <strong> Travel mode:</strong> {{$travelmode}}</h3>
                            </div>
                        </div>
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Fare</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                        @foreach($fares as $fare)
                                        <tr>
                                            <td>{{ucwords($fare['from'])}}</td>
                                            <td>{{ucwords($fare['to'])}}</td>
                                            <td>{{$fare['fare']}}</td>
                                            <td>
                                                <a href="#" title="apply" data-toggle="modal" data-target="#deleteModal{{ $fare['id'] }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-sign-out"></i></a>
                                                <div id="deleteModal{{ $fare['id'] }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Request for fare</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{route('travel-request.store')}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                                                    <input name="_token" type="hidden" value="{{csrf_token()}}">
                                                                    <div class="form-group">
                                                                        <label for="date_from">From Date</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </div>
                                                                            <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="start_date" type="text" id="start_date">
                                                                        </div>
                                                                        <input type="hidden" id="travel_perdiem_id" name="travel_perdiem_id" value="{{ $fare['id'] }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="date_to">To Date</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </div>
                                                                            <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="end_date" type="text" id="end_date">
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="applied_on" value="{{\Carbon\Carbon::now()}}">
                                                                    <div class="form-group">
                                                                        <label for="reason">Reason</label>
                                                                        <input required class="form-control" name="reason" type="text" id="reason">
                                                                    </div>

                                                                    <div class="pull-right">
                                                                        <input class="btn btn-success btn-flat" type="submit" value="Save">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>@endforeach
                                        </tbody>
                                    </table>
                                </div>
                        <div class="box-footer">
                            <a type="button" class="btn btn-default btn-flat btn-sm pull-right" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $id}}"><i class="fa fa-trash"></i></a>
                            <div id="deleteModal{{ $id }}" class="modal fade" role="dialog">
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
                                            {!! Form::open(['url' => ['travel-perdiem/'.$id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('travel-perdiem.edit',$id)}}" class="btn btn-default btn-sm btn-flat pull-right"><i class="fa fa-pencil"></i></a>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection

@section('foot')
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.datepicker').datepicker({
                autoclose: true,
                startDate: '+1d'
            });
            $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            $("[data-mask]").inputmask();

            $("select").select2({
                placeholder: "Select",
                allowClear: true
            });

            $( "#employee" ).autocomplete({
                source: "{{ asset('autocomplete/users')}}",
                minLength: 1,

                select: function(event, ui) {
                    $('#employee').val(ui.item.value);
                    $('#user_id').val(ui.item.id);
                }
            });

            $( "#leave_type" ).autocomplete({
                source: "{{ asset('autocomplete/leave_types')}}",
                minLength: 1,
                select: function(event, ui) {
                    $('#leave_type').val(ui.item.value);
                    $('#leave_type_id').val(ui.item.id);
                }
            });
        });
    </script>
@endsection