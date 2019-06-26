@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>
<link href="{{asset('dist/css/selector2.min.css')}}" rel="stylesheet" />
<script src="{{asset('dist/js/selector2.min.js')}}"></script>

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Modify Opening Balance
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                        <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Modify Opening Leave Balance </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('leave-balance.update',['id' =>$balance->id])}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <input type="hidden" name="id" value="{{$balance->id}}">
                                <div class="form-group">
                                    <label for="leave_type_id">Leave Type (Staff Should atleast assigned to 1 leave type)</label>
                                    <select name="leave_type_id" id="leave_type_id" class="form-control leave_type_id" required>
                                        <option value="">--Choose Leave Type--</option>
                                        @foreach($leave_types as $l_t)
                                            <option value="{{$l_t->id}}" {{$balance->leave_type_id == $l_t->id ? 'selected="selected"' : ''}} >{{$l_t->leave_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="staff_id">Staff</label>
                                    <select name="user_id" id="staff_id" class="form-control" required>
                                        <option value="{{$balance->user_id}}">{{$balance->staff->first_name.' '.$balance->staff->last_name}}</option>
                                        <option value="">--Choose Staff--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Balance</label>
                                    <input type="number" step="0.001" name="opening_balance" value="{{$balance->opening_balance}}" class="form-control" placeholder="Enter opening balance" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update Balance" class="btn btn-primary">
                                    <a href="{{url('/leave-balance')}}" class="btn btn-default">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script type="text/javascript">
    $(".leave_type_id").select2();

    $(function () {
        $("#leave_type_id").on('change',function () {
            var id = $(this).val();
            $.ajax({
                url:'{{url('users-attached')}}' + '/' +id,
                type:'GET',
                success: function (data) {

                    var staff = $("#staff_id");
                    staff.empty();
                    if (data) {
                        $.each(data, function (k, v) {
                            staff.append('<option value="' + v.id + '">' + v.first_name + ' ' + v.last_name + '</option>');
                        });
                    }
                }
            })
        })


    })
</script>
