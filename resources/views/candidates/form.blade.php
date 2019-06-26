@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>

@endsection
<h4 class="label label-success"> Personal Information</h4>
<hr/>
<div class="row">
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
			{!! Form::label('first_name', 'First Name') !!}
			{!! Form::text('first_name', null, ['class' => 'form-control' , 'pattern' => '[A-Za-z]+$', 'title' => 'Enter only letters']) !!}
			@if ($errors->has('first_name'))
				<span class="help-block">
					<strong>{{ $errors->first('first_name') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
			{!! Form::label('last_name', 'Last Name') !!}
			{!! Form::text('last_name', null, ['class' => 'form-control' , 'pattern' => '[A-Za-z]+$', 'title' => 'Enter only letters']) !!}
			@if ($errors->has('last_name'))
				<span class="help-block">
					<strong>{{ $errors->first('last_name') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			{!! Form::label('email', 'Email') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
			@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('contact_no') ? ' has-error' : '' }}">
			{!! Form::label('contact_no', 'Contact No') !!}
			{!! Form::text('contact_no', null, ['class' => 'form-control']) !!}
			@if ($errors->has('contact_no'))
				<span class="help-block">
					<strong>{{ $errors->first('contact_no') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>Gender</label>
			<select name="gender" class="form-control">
				<option value="MALE">Male</option>
				<option value="FEMALE">Female</option>
				<option value="NAN">Not Specified</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label>DOB</label>
			<input type="text" name="dob" class="form-control datepicker">
		</div>
	</div>
</div>
<h4 class="label label-success"> Professional information </h4>
<hr/>
<div class="row">
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('resume') ? ' has-error' : '' }}">
			{!! Form::label('resume', 'Resume') !!}
			{!! Form::file('resume') !!}
			@if ($errors->has('resume'))
				<span class="help-block">
					<strong>{{ $errors->first('resume') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('job_vacancy_id') || $errors->has('job_vacancy') ? ' has-error' : '' }}">
			{!! Form::label('job_vacancy_id', 'Job Vacancy') !!}<br />
			{!! Form::select('job_vacancy_id', $job_vacancies, null, ['class' => 'form-control']) !!}
			@if ($errors->has('job_vacancy_id') || $errors->has('designation_item'))
				<span class="help-block">
					<strong>{{ $errors->has('designation_item') ? $errors->first('designation_item') : $errors->first('job_vacancy_id') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<label>Job type</label>

		<select class="form-control" name="recruitment_type">
			@foreach($jobtypes as $jobtype)
			<option value="{{$jobtype->id}}"> {{$jobtype->name}}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
        <div class="form-group">
            <label> Skills</label>
             <textarea id="" name="skills" class="form-control summernote" required="true" rows="8"></textarea>
        </div>
	</div>
	<div class="col-md-12">
        <div class="form-group">
            <label> Experience</label>
             <textarea id="" name="experience" class="form-control summernote" required="true" rows="8"></textarea>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label>Expected Salary</label>
			<input type="number" name="salary" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Languages</label>
			<input type="text" name="language" class="form-control">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('application_date') ? ' has-error' : '' }}">
			{!! Form::label('application_date', 'Date of Application') !!}
			<div class="input-group">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				{!! Form::text('application_date', null, ['class' => 'form-control datepicker', 'data-inputmask' => "'alias': 'mm/dd/yyyy'", 'data-mask' => '']) !!}
			</div>
			@if ($errors->has('application_date'))
				<span class="help-block">
					<strong>{{ $errors->first('application_date') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
			{!! Form::label('status', 'Status') !!}
			<select name="status" class="form-control">
					@foreach($status as $st)
						<option value="{{ $st->id}}"> {{ $st->status}}</option>
					@endforeach
			</select>
			@if ($errors->has('status'))
				<span class="help-block">
					<strong>{{ $errors->first('status') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<label>Comments</label>
		<textarea name="comment" class="form-control" required="true"></textarea>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	<div class="pull-right">
		{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
		<a href="{{ asset('/candidates') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
	</div>
	</div>
</div>
