@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		 Initiate Appraisals 
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('alert.success')
			
				<a href="{{ url('activate-appraisal') }}" type="button" class="btn btn-success btn-flat margin">Initiate Appraisal</a>
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Active Appraisals </h3>
						
					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>Template Name</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Date Initialized</th>
								<th>Action</th>
								
							</tr>	
							<?php $i = 1; ?>
							@foreach($active_appraisals as $active)
							<tr>
								<td>{{$i}}</td>
								<td>
									@foreach($questionares as $questionare)
										@if($questionare->id == $active->appraisalquestionare_id)
											{{$questionare->name}}
										@endif
									@endforeach
								</td>
								<td> 
									<?php $quest = App\AppraisalQuestionare::findorFail($active->appraisalquestionare_id);
										$dept_id = $quest->department_id; ?>


									@foreach($departments as $department)
										@if($department->id == $dept_id)
											{{$department->department}}
										@endif
									@endforeach

							   </td>
								<td>
									<?php $quest = App\AppraisalQuestionare::findorFail($active->appraisalquestionare_id);
										$desig_id = $quest->designation_id; ?>


									@foreach($designations as $designation)
										@if($designation->id == $desig_id)
											{{$designation->designation_item}}
										@endif
									@endforeach
								
								</td>
								<td>{{ $active->created_at }}</td>
								<td>
									<div class="btn-group">
										<a href="#" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-download"></i></a>
									
										<a href="#" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
										
										<a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#"><i class="fa fa-trash"></i></a>
										<div id="#" class="modal fade" role="dialog">
											<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Confirm Delete</h4>
											</div>
											<div class="modal-body">
											<p>Are you sure you want to delete this item?</p>
											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
											
											</div>
											</div>
											</div>
										</div>
									
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
