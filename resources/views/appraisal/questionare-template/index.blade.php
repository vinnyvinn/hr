@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Appraisal Templates 
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('alert.success')
			
				<a href="{{ asset('/appraisal-template/create') }}" type="button" class="btn btn-success btn-flat margin">New Template</a>
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Appraisal Templates </h3>
						
					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>Template Name</th>
								<th>Department</th>
								<th>Designation</th>
								
								<th>Action</th>
								
							</tr>	
							<?php $i = 1; ?>
							@foreach($questionares as $questionare)
							<tr>
								<td>{{$i}}</td>
								<td>{{$questionare->name}}</td>
								<td>
                               	@foreach($departments as $department)
								  {{$questionare->department_id == $department->id ? $department->department : '' }}
								@endforeach
							   </td>
								<td>
								@foreach($designations as $designation)
								  {{$questionare->designation_id == $designation->id ? $designation->designation_item : '' }}
								@endforeach
								</td>
								<td>
									<div class="btn-group">

										<a href="{{ url('quiz/edit-temp/'.$questionare->id) }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
										<a href="{{ url('quiz/remove-temp/'.$questionare->id) }}" title="Remove" class="btn btn-default btn-flat btn-sm"><i class="fa fa-trash"></i></a>
										</div>
								</td>

							</tr>
							<?php $i++; ?>
							@endforeach			
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
