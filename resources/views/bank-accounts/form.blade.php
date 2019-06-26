<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
	<label for="user_id">Employee</label>
	<select name="user_id" id="user_id" class="form-control">
		@foreach($employees as $emp)
			<option value="{{$emp->id}}">{{$emp->first_name .' '.$emp->last_name}}</option>
	  @endforeach
	</select>
	@if ($errors->has('user_id'))
		<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
	{!! Form::label('account_name', 'Account Name') !!}
	<select name="account_name" id="account_name" class="form-control">
		@foreach($employees as $emp)
			<option value="{{$emp->first_name .' '.$emp->last_name}}">{{$emp->first_name .' '.$emp->last_name}}</option>
		@endforeach
	</select>
	@if ($errors->has('account_name'))
		<span class="help-block">
			<strong>{{ $errors->first('account_name') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
	{!! Form::label('account_number', 'Account Number') !!}
	{!! Form::text('account_number', null, ['class' => 'form-control']) !!}
	@if ($errors->has('account_number'))
		<span class="help-block">
			<strong>{{ $errors->first('account_number') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
	{!! Form::label('bank_name', 'Bank Name') !!}
	{!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
	@if ($errors->has('bank_name'))
		<span class="help-block">
			<strong>{{ $errors->first('bank_name') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('bank_code') ? ' has-error' : '' }}">
	{!! Form::label('bank_code', 'Bank Code') !!}
	{!! Form::text('bank_code', null, ['class' => 'form-control']) !!}
	@if ($errors->has('bank_code'))
		<span class="help-block">
			<strong>{{ $errors->first('bank_code') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
	{!! Form::label('branch_name', 'Branch Name') !!}
	{!! Form::text('branch_name', null, ['class' => 'form-control']) !!}
	@if ($errors->has('branch_name'))
		<span class="help-block">
			<strong>{{ $errors->first('branch_name') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('branch_code') ? ' has-error' : '' }}">
	{!! Form::label('branch_code', 'Branch Code') !!}
	{!! Form::text('branch_code', null, ['class' => 'form-control']) !!}
	@if ($errors->has('branch_code'))
		<span class="help-block">
			<strong>{{ $errors->first('branch_code') }}</strong>
		</span>
	@endif
</div>
<div class="pull-right">
	{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
	<a href="{{ isset($user->id) ? asset('/users/'.$user->id) : asset('/bank-accounts') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>
