@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Candidates
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">Edit Candidate</h3>
					</div>
					<div class="box-body">
						<form action="{{route('candidates.update',['id' => $candidate->id])}}" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}
							{{method_field('PUT')}}
							<h4 class="label label-success"> Personal Information</h4>
							<hr/>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
										{!! Form::label('first_name', 'First Name') !!}
										<input type="text" class="form-control" name="first_name" value="{{$candidate->first_name}}">

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
										<input type="text" class="form-control" name="last_name" value="{{$candidate->last_name}}">
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
										<input type="text" class="form-control" name="email" value="{{$candidate->email}}">
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
										<input type="text" class="form-control" name="contact_no" value="{{$candidate->contact_no}}">
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
											<option value="MALE" {{$candidate->gender == 'MALE' ? 'selected="selected"' : ''}}>Male</option>
											<option value="FEMALE" {{$candidate->gender == 'FEMALE' ? 'selected="selected"' : ''}}>Female</option>
											<option value="NAN" {{$candidate->gender == 'NAN' ? 'selected="selected"' : ''}}>Not Specified</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>DOB</label>
										<input type="text" name="dob" class="form-control datepicker" value="{{$candidate->dob}}">
									</div>
								</div>
							</div>
							<h4 class="label label-success"> Professional information </h4>
							<hr/>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group{{ $errors->has('resume') ? ' has-error' : '' }}">
										{!! Form::label('resume', 'Resume') !!}
										<input type="file" name="resume">
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
										<select name="job_vacancy_id" id="job_vacancy_id" class="form-control">
											@foreach($job_vacancies as $vacancy)
												<option value="{{$vacancy->id}}" {{$vacancy->id == $candidate->job_vacancy_id ? 'selected="selected"' : ''}}>{{$vacancy->job_title}}</option>
												@endforeach
										</select>

									</div>
								</div>
								<div class="col-md-4">
									<label>Job type</label>

									<select class="form-control" name="recruitment_type">
										@foreach($jobtypes as $jobtype)
											<option value="{{$jobtype->id}}" {{$jobtype->id == $candidate->recruitment_type ? 'selected="selected"' : ''}}> {{$jobtype->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label> Skills</label>
										<textarea id="" name="skills" class="form-control summernote" required="true" rows="8">{{$candidate->skills}}</textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label> Experience</label>
										<textarea id="" name="experience" class="form-control summernote" required="true" rows="8">{{$candidate->experience}}</textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Expected Salary</label>
										<input type="number" name="salary" class="form-control" value="{{$candidate->salary}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Languages</label>
										<input type="text" name="language" class="form-control" value="{{$candidate->language}}">
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
											<input type="text" name="application_date" class="form-control datepicker" value="{{$candidate->application_date}}">

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
												<option value="{{ $st->id}}" {{$st->id == $candidate->status ? 'selected="selected"' : ''}}> {{ $st->status}}</option>
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
									<textarea name="comment" class="form-control" required="true">{{$candidate->comment}}</textarea>
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
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript" src=" {{asset('note/summernote.min.js')}}"></script>
	<script type="text/javascript">
		$(function () {
			$('.datepicker').datepicker({
				autoclose: true
			});
			$("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			$("[data-mask]").inputmask();
			$("select").select2({
				placeholder: "Select",
				allowClear: true
			});
			$('.summernote').summernote({
				tabsize: 2,
				height: 150
			});
		});
    </script>
@endsection
