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
                Travel perdiem
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Edit Travel perdiem</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('travel-perdiem.update',$id)}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                {{method_field('PUT')}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="training_type">Select Department</label><br />
                                            <select class="form-control"  id="department_id" name="department_id">
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="training_type">Travel Mode</label><br />
                                            <select class="form-control"  id="travel_mode_id" name="travel_mode_id">
                                                @foreach($modes as $mode)
                                                    <option value="{{$mode->id}}">{{$mode->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-condensed table-stripped" >
                                            <thead>
                                            <tr>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Fare</th>
                                            </tr>
                                            </thead>
                                            <tbody id="travelId">
                                            @foreach($perdiems as $perdiem)
                                            <tr class="row_num">
                                                <td>
                                                    <div class="form-group">
                                                        <input required class="form-control" value="{{$perdiem->from_location}}" name="from_location[]" type="text" id="from_location">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input required class="form-control" value="{{$perdiem->to_location}}" name="to_location[]" type="text" id="to_location">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input required class="form-control" value="{{$perdiem->fare}}" name="fare[]" type="number" min="1" id="fare">
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" onclick="addRow()" class="btn pull-right btn-sm btn-primary" style="margin: 2px">add row</button>
                                        <button type="button" onclick="deleteRow()" class="btn pull-right btn-sm btn-warning" style="margin: 2px">delete</button>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{url('travel-perdiem')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
                                </div>
                            </form>

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
    <script>
        function addRow() {

            var data = '<tr class="row_num"><td><div class="form-group">'+
                    '<input required class="form-control" name="from_location[]" type="text" id="from_location">'+
                    '</div></td><td><div class="form-group">' +
                    '<input required class="form-control" name="to_location[]" type="text" id="to_location">'+
                    '</div></td><td><div class="form-group">' +
                    '<input required class="form-control" name="fare[]" type="text" id="fare">'+
                    '</div></td></tr>';

            $("#travelId").append(data);
            $( function() {
                $('.datepicker').datepicker({
                    autoclose: true,
                    startDate: '+1d'
                });
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $("[data-mask]").inputmask();
            } );

        }
        function deleteRow() {
            var numb = $("#travelId tr").length;
            if(numb > 1)
            {
                $("#travelId tr:last-child").remove();
            }

        }
    </script>

@endsection