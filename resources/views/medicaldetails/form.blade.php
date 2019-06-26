<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
	{!! Form::label('user_id', 'Employee') !!}
	{!! Form::text('employee', isset($bank_account) && $bank_account->user ? $bank_account->user->first_name.' '.$bank_account->user->last_name : (isset($user->id) ? $user->first_name.' '.$user->last_name : null), ['class' => 'form-control', 'id' => 'employee', isset($bank_account) || isset($user->id) ? 'disabled' : '']) !!}
	{!! Form::hidden('user_id', isset($user->id) ? $user->id : null, ['id' =>  'user_id']) !!}
	@if ($errors->has('user_id'))
		<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('blood_group') ? ' has-error' : '' }}">
	{!! Form::label('blood_group', 'Blood Group') !!}
	{!! Form::text('blood_group', null, ['class' => 'form-control']) !!}
	@if ($errors->has('blood_group'))
		<span class="help-block">
			<strong>{{ $errors->first('blood_group') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('allergies') ? ' has-error' : '' }}">
	{!! Form::label('allergies', 'Allergies') !!}
	{!! Form::text('allergies', null, ['class' => 'form-control']) !!}
	@if ($errors->has('allergies'))
		<span class="help-block">
			<strong>{{ $errors->first('allergies') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('doctor') ? ' has-error' : '' }}">
	{!! Form::label('doctor', 'Doctor') !!}
	{!! Form::text('doctor', null, ['class' => 'form-control']) !!}
	@if ($errors->has('doctor'))
		<span class="help-block">
			<strong>{{ $errors->first('doctor') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('clinic_tel') ? ' has-error' : '' }}">
	{!! Form::label('clinic_tel', 'Clinic Tel') !!}
	{!! Form::text('clinic_tel', null, ['class' => 'form-control']) !!}
	@if ($errors->has('clinic_tel'))
		<span class="help-block">
			<strong>{{ $errors->first('clinic_tel') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
	{!! Form::label('disabled', 'Disabled') !!}
	{!! Form::select('disabled', array('NO' => 'NO','YES'=>'YES'),null,['class'=>'form-control']) !!}
	@if ($errors->has('disabled'))
		<span class="help-block">
			<strong>{{ $errors->first('disabled') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('prescription') ? ' has-error' : '' }}">
	{!! Form::label('prescription', 'Medical Prescription') !!}
	{!! Form::text('prescription', null, ['class' => 'form-control']) !!}
	@if ($errors->has('prescription'))
		<span class="help-block">
			<strong>{{ $errors->first('prescription') }}</strong>
		</span>
	@endif
</div>
<div class="pull-right">
	{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
	<a href="{{ isset($user->id) ? asset('/users/'.$user->id) : asset('/bank-accounts') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>