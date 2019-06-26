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
                Leave Assignment
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Assign Leave </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('leave-days')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="leave-type">Leave Type</label>
                                    <select name="leave_type" id="leave-type" class="form-control" required>
                                        <option value="">--Choose Leave Type--</option>
                                    @foreach($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->leave_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="staff-id">Staff</label>
                                    <select name="staff_id" id="staff-id" class="form-control select2" required>

                                          <option value="">Please Choose Leave Type First</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="leave-days">Leave Days</label>
                                    <input type="number" class="form-control" name="leaves_no" id="leave-days" required>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="1" name="can_exceed_limit">Can exceed limit</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                                <button  class="btn btn-danger" value="close" name="close">Reset</button>
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
        $(".select2").select2();
        $( document ).ready(function() {
            $('#leave-type').on('change', function(e) {
                //console.log(e);
                var leave_id = e.target.value;
                //console.log('id='+leave_type)
                //ajax
                console.log(leave_id);
                 $.getJSON("/users-attached/"+leave_id, function (data) {
                  // console.log(data);
                    $('#staff-id').empty();
                    $.each(data, function(index, staffsObj){
                          console.log(staffsObj)
                        $('#staff-id').append('<option value="'+staffsObj.id+'">'+staffsObj.first_name+' '+staffsObj.last_name+'</option>');
                    });
                });
            });

        });

        $('#leave-type').select2();

    </script>

@endsection
