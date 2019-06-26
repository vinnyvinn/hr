@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1 class="text-center">
		Appraisal 
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">lastly select employees to participate in the appraisal</h3>
					</div>
					<div class="box-body">
						<form method="post" action="{{ url('process-finailization')}}">
							{{csrf_field()}}
							<input type="hidden" name="questionare_id" value="{{ $questionare->id}}">
							
							<div class="form-group">
								<label for="department_id">Department </label>
								<select name="department_id" class="form-control" required="true">
									@foreach($departments as $department)
										@if($questionare->department_id == $department->id)
										 <option value="{{$questionare->department_id}}" selected="true" disabled="true">{{$department->department}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="designation_id">Designation </label>
								<select name="designation_id" class="form-control" required="true">
									@foreach($designations as $designation)
										@if($designation->id == $questionare->designation_id)
										 <option value="{{ $questionare->designation_id}}" selected="true" disabled="true">{{$designation->designation_item}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<hr>
							<div class="form-group">
								<label>Employees to choose from</label></br>

								@foreach($employees as $employee)
								<input type="checkbox" name="employees[]" value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}} &nbsp;
								@endforeach
							<hr>
                          <br>

							</div>

							
							<div class="form-group">
								 <button class="btn btn-success" type="submit">Finalize <i class="fa fa-arrow-circle-right"></i> </button>
							</div>

							
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
