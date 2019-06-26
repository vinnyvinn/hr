<script src="{{asset('dist/js/jquery.js')}}"></script>
@if(! isset($action))
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
@endif

<div class="form-group{{ $errors->has('leave_type_id') || $errors->has('leave_type') ? ' has-error' : '' }}">
	{!! Form::label('leave_type_id', 'Leave Type') !!}<br />
	{!! Form::select('leave_type_id', $leave_types, null, ['class' => 'form-control leave_type', isset($action) ? 'disabled' : '']) !!}
	@if ($errors->has('leave_type_id') || $errors->has('leave_type'))
		<span class="help-block">
			<strong>{{ $errors->has('leave_type') ? $errors->first('leave_type') : $errors->first('leave_type_id') }}</strong>
		</span>
	@endif

</div>

<p class="days">Days Remaning: </p>

<div class="form-group{{ $errors->has('type') || $errors->has('type') ? ' has-error' : '' }} l_type">
	{!! Form::label('type', 'Type') !!}<br />
	<select name="type" id="type" class="form-control" style="width: 100%">
		<option></option>
		@foreach($types as  $type)
		<option value="{{$type}}">{{$type}}</option>
		@endforeach
	</select>
	@if ($errors->has('type') || $errors->has('type'))
		<span class="help-block">
			<strong>{{ $errors->has('type') ? $errors->first('type') : $errors->first('type') }}</strong>
		</span>
	@endif
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
	<?php

	$lv = $leave->staff ? $leave->staff->id : '' ?>
	<select name="staff_id" id="staff_id" class="form-control">
		<option value="">--Choose Staff--</option>
		@foreach($staffs as $staf)
			<option value="{{$staf->id}}" {{$lv == $staf->id ? 'selected="selected"' : ''}} >{{$staf->first_name .' '.$staf->last_name}}</option>
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
	{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
	<a href="{{ isset($user->id) ? asset('/users/'.$user->id) : asset('/leaves') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>
<script>
	$('.days').hide();
	$(function () {
  $('.leave_type').on('change',function () {
  	$('.days').show();

	  $.ajax({
		  url:'{{url('remaining-days')}}'+'/'+$(this).val(),
		  type:'GET',
		  success: function (response) {
			  console.log(response);
			  $('.days').text('Days Remaining: '+response)
		  }
	  })
  })
        $('.datepicker').on('hover',function () {
            console.log('walla')
            console.log($(this).val());

        })

         $('.l_type').hide();
		$(".leave_type").on('change',function () {
			var id = $(this).val();
			//console.log(id);
			$.ajax({
				url:'{{url('get-leave-type')}}'+'/'+id,
				type:'GET',
				success: function (response) {

					if (response == 'found'){
						$('.l_type').show();
					}
					if (response =='notfound')
					$('.l_type').hide();
				}
			});
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
</script>
