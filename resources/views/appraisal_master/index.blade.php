@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <style>

        .select2-container--default{
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Appraisal Templates
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    <a href="{{ url('/appraisal-master/create') }}" type="button" class="btn btn-success btn-flat margin"><i class="fa fa-plus-square-o" aria-hidden="true">Add New</i></a> </a>

                    <a href="#" class="btn btn-success btn-flat margin walla" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-square-o" aria-hidden="true">Assign</i></a>
                    <a href="#" class="btn btn-success btn-flat margin walla edit_form"><i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></a>
                    <a href="#" class="btn btn-success btn-flat margin walla copy"><i class="fa fa-copy" aria-hidden="true">Copy as New</i></a>
                    <a href="#" class="btn btn-success btn-flat margin walla delete_items"><i class="fa fa-trash-o" aria-hidden="true">Delete</i></a>
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Appraisal Master</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Template Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template->id }}</td>
                                        <td><input type="checkbox" class="template_check" value="{{$template->id}}"></td>
                                        <td>{{$template->template->name}}</td>
                                        <td>{{$template->department ? $template->department->department:''}}</td>
                                        <td>{{$template->designation_item ? $template->designation_item->designation_item:''}}</td>
                                        <td>
                                            @if($template->user_id)
                                                <?php
                                                $users_here = \App\User::whereIn('id',json_decode($template->user_id))->get();

                                                ?>
                                                <ul class="list-group">
                                                    @foreach($users_here as $u)
                                                        <li class="list-group-item">
                                                            {{$u->first_name .' '.$u->last_name}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </td>
                                        <td>
                                            @if($template->status ==\App\AppraisalMaster::STATUS_NEW)
                                                <span class="label label-warning"> {{$template->status}}</span>
                                            @elseif($template->status ==\App\AppraisalMaster::STATUS_WIP)
                                                <span class="label label-default"> {{$template->status}}</span>
                                            @else
                                                <span class="label label-success"> {{$template->status}}</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Assign Form</h4>
                                </div>
                                <form action="{{url('assign-template')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-md-10 col-md-offset-1">

                                                <div class="form-group">
                                                    <label for="name">Appraisal Template Name</label>
                                                    <select name="template_id" id="template_id" class="form-control select2" required>
                                                        @foreach($sorted_templates as $templ)
                                                            <option value="{{$templ->id}}">{{$templ->template->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="department_id">Department</label>
                                                    <select name="department_id" id="department_id" class="form-control select2" required>
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->id}}">{{$department->department}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="department_id">Designation</label>
                                                    <select name="designation_id" id="designation_id" class="form-control select2" required>
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="user_id">Employee</label>
                                                    <select name="user_id[]" id="user_id" class="form-control select2" multiple required>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="staff_id">Search Employee</label>
                                                    <select name="staff_id[]" id="staff_id" class="form-control select2" multiple>
                                                        @foreach($employees as $emp)
                                                            <option value='{{$emp->id}}'>{{$emp->first_name.' '.$emp->last_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>

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
    <script>
        $('.walla').hide();
        $('.select2').select2();
        jQuery(function($) {
            var check_id;
            var all_ids;
            $('.template_check').on('change',function () {
                check_id = $(this).val();
                var searchIDs = $('input:checked').map(function(){
                    return $(this).val();
                });
                all_ids=searchIDs.get();
                console.log(searchIDs.get().length);
                if(searchIDs.get().length > 0){
                    $('.walla').show();
                }
                else{
                    $('.walla').hide();
                }

                //Edit seleted
                $('.edit_form').on('click',function () {
                    window.location.href='{{url('appraisal-master')}}'+'/'+check_id+'/edit';

                })

                //Copy the Selected as new
                $('.copy').on('click',function () {
                    $.ajax({
                        url:'{{url('copy-new')}}'+'/'+check_id,
                        datatype:'GET',
                        success: function (response) {
                            window.location.reload();
                        }
                    })
                })

                //Delete the selected items
                $('.delete_items').on('click',function () {

                    $.ajax({
                        url:'{{url('delete-bulk')}}',
                        datatype:'GET',
                        data:{id:all_ids},
                        success:function (response) {
                            window.location.reload();
                        }
                    })
                })
            });
            var desination_id;
            $('#department_id').on('change',function () {
                var department =  $(this).val();

                // Empty the dropdown
                $('#designation_id').find('option').not(':first').remove();

                $.ajax({
                    url:'{{url('get-designations')}}'+'/'+department,
                    datatype:'GET',
                    success: function (response) {

                        var len = 0;
                        if (response != null) {
                            len = response.length;
                        }
                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response[i].id;
                                var name = response[i].designation_item;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $("#designation_id").append(option);
                            }

                        }

                        $('#designation_id').on('change',function () {
                            //get Employees
                            $('#user_id').find('option').not(':first').remove();
                            desination_id = $(this).val();
                            $.ajax({
                                url:'{{url('staff-by-designation')}}'+'/'+desination_id,
                                datatype:'GET',
                                success:function (response) {
                                    var len = 0;
                                    if (response != null) {
                                        len = response.length;
                                    }
                                    if (len > 0) {
                                        // Read data and create <option >
                                        for (var i = 0; i < len; i++) {
                                            var id = response[i].id;
                                            var name = response[i].first_name +' '+response[i].last_name;
                                            var option = "<option value='" + id + "'>" + name + "</option>";
                                            $("#user_id").append(option);
                                        }

                                    }
                                    //Search Employees
                                    $('#staff_id').find('option').not(':first').remove();
                                    $.ajax({
                                        url:'{{url('all-staff')}}'+'/'+desination_id,
                                        datatype:'GET',
                                        success: function (response) {
                                            var len = 0;
                                            if (response != null) {
                                                len = response.length;
                                            }
                                            if (len > 0) {
                                                // Read data and create <option >
                                                for (var i = 0; i < len; i++) {
                                                    var id = response[i].id;
                                                    var name = response[i].first_name +' '+response[i].last_name;
                                                    var option = "<option value='" + id + "'>" + name + "</option>";
                                                    $("#staff_id").append(option);
                                                }

                                            }
                                        }
                                    })
                                }
                            })
                        })

                    }

                })
            })


            //initiate dataTables plugin
            var myTable =
                $('.dataTable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable( {
                        bAutoWidth: false,
                        "aoColumns": [
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null

                        ],
                        "aaSorting": [],

                        select: {
                            style: 'multi'
                        }
                    });
        });


    </script>

@endsection
