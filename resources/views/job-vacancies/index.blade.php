@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Job Vacancies
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('alert.success')
				@if(Auth::user()->role->role_permission('create_job_vacancies'))
				<a href="{{ asset('/job-vacancies/create') }}" type="button" class="btn btn-success btn-flat margin">New Job Vacancy</a>
				@endif
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Job Vacancy List</h3>

					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover dataTable">
							<tr>
								<th>ID</th>
								<th>Job Title</th>
								<th>Hiring Manager</th>
								<th>Status</th>
								@if(Auth::user()->role->role_permission('edit_job_vacancies') || Auth::user()->role->role_permission('delete_job_vacancies'))
								<th>Action</th>
								@endif
							</tr>
							@foreach($job_vacancies as $job_vacancy)
							<tr>
								<td>{{ $job_vacancy->id }}</td>
								<td>{{ $job_vacancy->job_title }}</td>
								<td><a href="{{ $job_vacancy->user ? asset('/users/'.$job_vacancy->user->id) : '' }}"></a>{{ $job_vacancy->user ? $job_vacancy->user->first_name.' '.$job_vacancy->user->last_name : '' }}</td>
								<td>{{ $job_vacancy->status_text }}</td>
								@if(Auth::user()->role->role_permission('edit_job_vacancies') || Auth::user()->role->role_permission('delete_job_vacancies'))
								<td>
									<div class="btn-group">
										@if(Auth::user()->role->role_permission('edit_job_vacancies'))
										<a href="{{ asset('job-vacancies/'.$job_vacancy->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
										@endif
										@if(Auth::user()->role->role_permission('delete_job_vacancies'))
										<a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $job_vacancy->id }}"><i class="fa fa-trash"></i></a>
										<div id="deleteModal{{ $job_vacancy->id }}" class="modal fade" role="dialog">
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
											{!! Form::open(['url' => ['job-vacancies/'.$job_vacancy->id], 'method' => 'delete']) !!}
											{!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
											{!! Form::close() !!}
											</div>
											</div>
											</div>
										</div>
										@endif
									</div>
								</td>
								@endif
							</tr>
							@endforeach
						</table>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('foot')
	<script>

		jQuery(function($) {
			//initiate dataTables plugin
			var myTable =
					$('.dataTable')
					//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
							.DataTable( {
								bAutoWidth: false,
								"aoColumns": [
									null,
									null,
									null,
									null,
									null
								],
								"aaSorting": [],


								//"bProcessing": true,
								//"bServerSide": true,
								//"sAjaxSource": "http://127.0.0.1/table.php"   ,

								//,
								//"sScrollY": "200px",
								//"bPaginate": false,

								//"sScrollX": "100%",
								//"sScrollXInner": "120%",
								//"bScrollCollapse": true,
								//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
								//you may want to wrap the table inside a "div.dataTables_borderWrap" element

								//"iDisplayLength": 50


								select: {
									style: 'multi'
								}
							});
		});
	</script>

@endsection
