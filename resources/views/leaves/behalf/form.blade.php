@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

<script src="{{asset('dist/js/jquery.js')}}"></script>
@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Onbehalf Leave
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Apply Leave Onbehalf</h3>
                        </div>
                        <div class="box-body">

<form action="{{route('leaves-onbehalf.store')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}


<div class="form-group{{ $errors->has('leave_type_id') || $errors->has('leave_type') ? ' has-error' : '' }}">
    {!! Form::label('leave_type_id', 'Leave Type') !!}<br />
    {!! Form::select('leave_type_id', $leave_types, null, ['class' => 'form-control leave_type', isset($action) ? 'disabled' : '']) !!}
    @if ($errors->has('leave_type_id') || $errors->has('leave_type'))
        <span class="help-block">
			<strong>{{ $errors->has('leave_type') ? $errors->first('leave_type') : $errors->first('leave_type_id') }}</strong>
		</span>
    @endif
</div>
<div class="form-group">
    <label for="user_id">Choose Staff</label>
    <select name="emp_id" id="user_id" class="form-control user_id" required>
        <option></option>
        @foreach($staffs as $user)
        <option value="{{$user->id}}">{{$user->first_name .' '.$user->last_name}}</option>
            @endforeach
    </select>
</div>
<div class="form-group{{ $errors->has('date_from') ? ' has-error' : '' }}">
    {!! Form::label('date_from', 'Date From') !!}
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_from', null, [isset($action) ? 'disabled' : '', 'class' => 'form-control datepicker', 'data-inputmask' => "'alias': 'mm/dd/yyyy'", 'data-mask' => '']) !!}
    </div>
    @if ($errors->has('date_from'))
        <span class="help-block">
			<strong>{{ $errors->first('date_from') }}</strong>
		</span>
    @endif
</div>
<div class="form-group{{ $errors->has('date_to') ? ' has-error' : '' }}">
    {!! Form::label('date_to', 'Date To') !!}
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('date_to', null, [isset($action) ? 'disabled' : '', 'class' => 'form-control datepicker', 'data-inputmask' => "'alias': 'mm/dd/yyyy'", 'data-mask' => '']) !!}
    </div>
    @if ($errors->has('date_to'))
        <span class="help-block">
			<strong>{{ $errors->first('date_to') }}</strong>
		</span>
    @endif
</div>
<input type="hidden" name="applied_on" value="{{ \Carbon\Carbon::now() }}">

<div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
    {!! Form::label('reason', 'Reason') !!}
    {!! Form::text('reason', null, [isset($action) ? 'disabled' : '', 'class' => 'form-control']) !!}
    @if ($errors->has('reason'))
        <span class="help-block">
			<strong>{{ $errors->first('reason') }}</strong>
		</span>
    @endif
</div>
<div class="form-group backstopped">
    <label for="staff_id">Backstopped By</label>

      <select name="staff_id" id="staff_id" class="form-control">
        <option value="">--Choose Staff--</option>
        @foreach($staffs as $staf)
            <option value="{{$staf->id}}">{{$staf->first_name .' '.$staf->last_name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="document">Upload document(optional)</label>
    <input type="file" name="document" id="document" class="form-control">
</div>
<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
    {!! Form::label('comment', 'Comment') !!}
    {!! Form::text('comment', null, [isset($action) ? 'disabled' : '', 'class' => 'form-control']) !!}
    @if ($errors->has('comment'))
        <span class="help-block">
			<strong>{{ $errors->first('comment') }}</strong>
		</span>
    @endif
</div>
@if(isset($action))
    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label for="status">Process Request</label>
        <select name="status" id="status" class="form-control">
            <option value="1">Approve Request</option>
            <option value="2">Disapprove Request</option>
        </select>
        @if ($errors->has('status'))
            <span class="help-block">
			<strong>{{ $errors->first('status') }}</strong>
		</span>
        @endif
    </div>
@endif
    <div class="pull-right">
    <input type="submit" class="btn btn-success btn-flat" value="Save">
        <a type="button" href="{{url('leaves')}}" class="btn btn-default btn-flat">Cancel</a>
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
    $(function () {
        var leave_type;
        var user_id;

        $('.leave_type').on('change',function () {
            leave_type= $(this).val();

            $('.user_id').on('change',function () {
                user_id=$('.user_id').val();

                console.log(leave_type)
                console.log(user_id)
            });

        })

        //console.log(leave_type);
        $('.datepicker').datepicker({
            autoclose: true
            
        });
        $(".leave_type").on('change',function () {
            var id = $(this).val();
            $.ajax({
                url:'{{url('back-stop')}}' +'/'+id,
                type:'GET',
                success: function (data) {

                    if(data == 1){
                        $(".backstopped").show();
                    }
                    else {
                        $(".backstopped").hide();
                    }
                }
            })
        })

    })
    $('#user_id,#staff_id,.leave_type').select2();
</script>
    @endsection
