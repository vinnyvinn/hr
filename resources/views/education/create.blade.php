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
                Education
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12 col-md-offset-0">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Education Record</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('education.store')}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">

                                <div class="col-md-12 col-md-offset-0">
                                    <div class="box box-default" style="border:solid 1px">
                                        <div class="box-header">
                                            <h4 class="box-title">High School</h4>
                                        </div>
                                        <div class="box-body">

                                            <div class="col-md-12" style="margin: 5px">
                                                <table class="table table-condensed table-stripped" >
                                                    <tbody id="highschool">
                                                    <tr class="row_num">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_institution">High School Attended</label>
                                                                <input required class="form-control" name="highschool[][education_institution]" type="text" id="education_institution">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="start_date">Start Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="highschool[][start_date]" type="text" id="start_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="highschool[][end_date]" type="text" id="end_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_grade">High School Grade</label><br>
                                                                <select required class="form-control" name="highschool[][education_grade]" id="education_grade">
                                                                    <option value="" selected="selected" hidden>Select Grade</option>
                                                                    <option value="A">A</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B">B</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="C+">C+</option>
                                                                    <option value="C">C</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input class="form-control" required name="highschool[][education_title]" value="not applicable" type="hidden" id="education_title">
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" onclick="addRow('highschool')" class="btn pull-right btn-xs btn-primary" style="margin: 2px">add university</button>
                                                <button type="button" onclick="deleteRow('highschool')" class="btn pull-right btn-xs btn-warning" style="margin: 2px">delete</button>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-md-offset-0">
                                <div class="box box-default" style="border:solid 1px">
                                    <div class="box-header">
                                        <h4 class="box-title">University</h4>
                                    </div>
                                    <div class="box-body">
                                            <div class="col-md-12" style="margin: 5px">
                                                <table class="table table-condensed table-stripped" >
                                                    <tbody id="recruittable">
                                                    <tr class="row_num">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_institution">University Attended</label>
                                                                <input required class="form-control" name="education_institution[]" type="text" id="education_institution">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="start_date">Start Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="start_date[]" type="text" id="start_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="end_date[]" type="text" id="end_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <br>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_grade">Degree Class</label><br>
                                                                <select required class="form-control" name="education_grade[]" id="education_grade">
                                                                    <option value="" disabled selected="selected" hidden>Select Degree Class</option>
                                                                    <option value="First Class">First Class Honours</option>
                                                                    <option value="Second Class Upper">Second Class Upper</option>
                                                                    <option value="Second Class Lower">Second Class Lower</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_title">University Degree</label>
                                                                <input class="form-control" required name="education_title[]" placeholder="e.g BSCs Computer Science" type="text" id="education_title">
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" onclick="addRow('recruittable')" class="btn pull-right btn-xs btn-primary" style="margin: 2px">add university</button>
                                                <button type="button" onclick="deleteRow('recruittable')" class="btn pull-right btn-xs btn-warning" style="margin: 2px">delete</button>
                                            </div>
                                    </div>
                            </div>
                                </div>

                                <div class="col-md-12 col-md-offset-0">
                                <div class="box box-default" style="border:solid 1px">
                                    <div class="box-header">
                                        <h4 class="box-title">Professional Qualification</h4>
                                    </div>
                                    <div class="box-body">
                                            <div class="col-md-12" style="margin: 5px">
                                                <table class="table table-condensed table-stripped" >
                                                    <tbody id="professional">
                                                    <tr class="row_num">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_institution">Institution Attended</label>
                                                                <input required class="form-control" name="professional_institution[]" type="text" id="education_institution">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="start_date">Start Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="professional_start_date[]" type="text" id="start_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="professional_date[]" type="text" id="end_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <br>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="education_institution">Grade/Qualification</label>
                                                                <input required class="form-control" name="professional_grade[]" type="text" id="education_grade">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="education_title">Professional Title</label>
                                                            <input class="form-control" required name="professionalx[education_title[]]"  type="text" id="education_title">
                                                        </div>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" onclick="addRow('professional')" class="btn pull-right btn-xs btn-primary" style="margin: 2px">add professional</button>
                                                <button type="button" onclick="deleteRow('professional')" class="btn pull-right btn-xs btn-warning" style="margin: 2px">delete</button>
                                            </div>
                                    </div>
                            </div>
                        </div>

                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="http://localhost:8000/leaves" type="button" class="btn btn-default btn-flat">Cancel</a>
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
        function addRow(data_data) {
            if(data_data == 'highschool') {
                var data = '<tr><td><div class="col-sm-6"><div class="form-group"><label for="education_institution">High School Attended</label>' +
                        '<input required class="form-control" name="highschool[][education_institution]" type="text" id="education_institution"></div></div>' +
                        '<div class="col-sm-3"><div class="form-group"> <label for="start_date">Start Date</label> <div class="input-group">' +
                        '<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>' +
                        '<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="highschool[][start_date]" type="text" id="start_date">' +
                        '</div> </div></div><div class="col-sm-3"><div class="form-group"> <label for="end_date">End Date</label> <div class="input-group">' +
                        '<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>' +
                        '<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="highschool[][end_date]" type="text" id="end_date">' +
                        '</div> </div></div><br><div class="col-sm-6"><div class="form-group"> <label for="education_grade">High School Grade</label><br>' +
                        '<select required class="form-control" name="highschool[][education_grade]" id="education_grade">' +
                        '<option value="" selected="selected" hidden>Select Grade</option> <option value="A">A</option> <option value="A-">A-</option> <option value="B+">B+</option> <option value="B">B</option>' +
                        '<option value="B-">B-</option> <option value="C+">C+</option> <option value="C">C</option> </select> </div></div>' +
                        '<input class="form-control" required name="highschool[][education_title]" value="not applicable" type="hidden" id="education_title"> </td></tr>';
            }

            else if(data_data == 'professional') {
                var data = '<tr><td><div class="col-sm-6"><div class="form-group"><label for="education_institution">Institution Attended</label>' +
                        '<input required class="form-control" name="professional_institution[]" type="text" id="education_institution"> </div></div>' +
                        '<div class="col-sm-3"><div class="form-group"> <label for="start_date">Start Date</label>' +
                        '<div class="input-group"> <div class="input-group-addon"> <i class="fa fa-calendar"></i>' +
                        '</div> <input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="professional_date[]" type="text" id="start_date">' +
                        '</div> </div></div><div class="col-sm-3"><div class="form-group"> <label for="end_date">End Date</label> <div class="input-group">' +
                        '<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>' +
                        '<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="highschool[][end_date]" type="text" id="end_date">' +
                        '</div> </div></div><br><div class="col-sm-6"><div class="form-group"><label for="education_institution">Grade/Qualification</label>' +
                        '<input required class="form-control" name="professional_grade[]" type="text" id="education_grade"> </div> </div>' +
                        '<div class="col-sm-6"><label for="education_title">Professional Title</label>' +
                        '<input class="form-control" required name="professionalx[education_title[]]"  type="text" id="education_title"> </div></td></tr>';
            }
            else {
                var data = '<tr class="row_num">' +
                        '<td><div class="col-sm-6">' +
                        '<div class="form-group"> <label for="education_institution">University Attended</label>' +
                        '<input required class="form-control" name="education_institution[]" type="text" id="education_institution"> </div>' +
                        '</div><div class="col-sm-3"><div class="form-group"> <label for="start_date">Start Date</label>' +
                        '<div class="input-group"> <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>' +
                        '<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="start_date[]" type="text" id="start_date"> </div>' +
                        '</div></div>' +
                        '<div class="col-sm-3"><div class="form-group"> <label for="end_date">End Date</label>' +
                        '<div class="input-group"> <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>' +
                        '<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="end_date[]" type="text" id="end_date"> </div>' +
                        '</div></div><div class="col-sm-6"><div class="form-group"> <label for="education_grade">Degree Class</label><br>' +
                        '<select required class="form-control" name="education_grade[]" id="education_grade"> <option value="" disabled selected="selected" hidden>Select Degree Class</option> <option value="First Class">First Class Honours</option>' +
                        '<option value="Second Class Upper">Second Class Upper</option><option value="Second Class Lower">Second Class Lower</option>' +
                        '<option value="Other">Other</option> </select> </div></div><div class="col-sm-6"><div class="form-group">' +
                        '<label for="education_title">University Degree</label> <input class="form-control" required name="education_title[]" placeholder="e.g BSCs Computer Science" type="text" id="education_title">' +
                        '</div></div></td></tr>';
            }
            $('#'+data_data).append(data);
            $( function() {
                $('.datepicker').datepicker({
                });
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                $("[data-mask]").inputmask();
            } );

        }
        function deleteRow(id_delete) {
            var numb = $('#'+id_delete+' tr').length;
            if(numb > 1)
            {
                $('#'+id_delete+' tr:last-child').remove();
            }

        }
    </script>
    <script type="text/javascript">
        $(function () {
            $('.datepicker').datepicker({
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

        });
    </script>
@endsection