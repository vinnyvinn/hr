<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
	{!! Form::label('user_id', 'Employee') !!}
	<select name="user_id" id="user_id" class="form-control">
		@foreach($employees as $empl)
			<option value="{{$empl->id}}">{{$empl->first_name.' '.$empl->last_name}}</option>
			@endforeach
	</select>
	@if ($errors->has('user_id'))
		<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('award_name') ? ' has-error' : '' }}">
	{!! Form::label('award_name', 'Award Name') !!}
	<input type="text" class="form-control" name="award_name" required>
	@if ($errors->has('award_name'))
		<span class="help-block">
			<strong>{{ $errors->first('award_name') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('gift_item') ? ' has-error' : '' }}">
	{!! Form::label('gift_item', 'Gift Item') !!}
	<input type="text" class="form-control" name="gift_item" required>
	@if ($errors->has('gift_item'))
		<span class="help-block">
			<strong>{{ $errors->first('gift_item') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('cash_price') ? ' has-error' : '' }}">
	{!! Form::label('cash_price', 'Cash Price') !!}
	<input type="text" class="form-control" name="cash_price" required>
	@if ($errors->has('cash_price'))
		<span class="help-block">
			<strong>{{ $errors->first('cash_price') }}</strong>
		</span>
	@endif
</div>
<div class="pull-right">
	{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
	<a href="{{ url('/awards')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>
