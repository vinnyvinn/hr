<div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
	{!! Form::label('question', 'Question') !!}
	{!! Form::text('question', null, ['class' => 'form-control']) !!}
	@if ($errors->has('question'))
		<span class="help-block">
			<strong>{{ $errors->first('question') }}</strong>
		</span>
	@endif
</div>
<div class="form-group{{ $errors->has('question_type_id') || $errors->has('question_type') ? ' has-error' : '' }}">
<label for="question_type_id">Question type</label>
		<select class="form-control" name="question_type_id">
			
			@foreach($question_types as $type)

			<option value="{{$type->id}}">{{$type->name}}</option>

			@endforeach

		</select>
		<span class="help-block">
			<strong>{{ $errors->has('question_type') ? $errors->first('question_type') : $errors->first('question_type_id') }}</strong>
		</span>
	
</div>
<div class="pull-right">
	{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
	<a href="#" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>