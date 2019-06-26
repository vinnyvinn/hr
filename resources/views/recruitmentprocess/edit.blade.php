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
                Recruitment
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Edit Recruitment Process</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('recruitment.update',$typeid)}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label for="recruitment_type">Select Recruitment Type</label><br />
                                    <select class="form-control"  id="recruitment_type" name="recruitment_type">
                                        @foreach($recruitmenttypes as $recruitmenttype)
                                            <option value="{{$recruitmenttype->id}}" {{$typeid == $recruitmenttype->id ? 'selected' : ''}}>{{$recruitmenttype->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12" style="margin: 5px">
                                    <table class="table table-condensed table-stripped" >
                                        <tr>
                                            {{--<th>No:</th>--}}
                                            <th>Process</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                        </tr>
                                        <tbody id="recruittable">
                                        @foreach($processes as $process)
                                        <tr class="row_num">
                                            {{--<td>1</td>--}}
                                            <td><div class="form-group">
                                                    <input class="form-control" value="{{$process->process}}" name="process[]" type="text" id="process">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input value="{{$process->start_date}}" class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="start_date[]" type="text" id="start_date">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input class="form-control datepicker" value="{{$process->end_date}}" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="end_date[]" type="text" id="end_date">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="button" onclick="addRow()" class="btn pull-right btn-sm btn-primary" style="margin: 2px">add row</button>
                                    <button type="button" onclick="deleteRow()" class="btn pull-right btn-sm btn-warning" style="margin: 2px">delete</button>
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{url('/recruitment')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
                    '<input class="form-control" name="process[]" type="text" id="process">'+
                    '</div></td><td><div class="form-group"><div class="input-group">'+
                    '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>'+
                    '<input class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="start_date[]" type="text" id="start_date">'+
                    '</div></div></td><td><div class="form-group"><div class="input-group"><div class="input-group-addon">'+
                    '<i class="fa fa-calendar"></i></div>'+
                    '<input class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="end_date[]" type="text" id="end_date">'+
                    '</div></div></td></tr>';


            $("#recruittable").append(data);
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
            var numb = $("#recruittable tr").length;
            if(numb > 2)
            {
                $("#recruittable tr:last-child").remove();
            }

        }
    </script>
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
