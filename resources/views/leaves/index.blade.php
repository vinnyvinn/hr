@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Leaves
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('alert.success')
				@if(Auth::user()->role->role_permission('create_leaves'))
				<a href="{{ asset('/leaves/create') }}" type="button" class="btn btn-success btn-flat margin">New Leave</a>
				@endif
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Leave List</h3>

					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover dataTable">
							<tr>
								<th>ID</th>
								<th>Employee</th>
								<th>Leave Type</th>
								<th>Date From</th>
								<th>Date To</th>
								<th>Applied On</th>
								<th>Reason</th>
								<th>Comment</th>
								<th>Status</th>
								@if(Auth::user()->role->role_permission('edit_leaves') || Auth::user()->role->role_permission('delete_leaves'))
								<th>Action</th>
								@endif
							</tr>
							@foreach($leaves as $leave)

							<tr>
								<td>{{ $leave->id }}</td>
								<td>
								@if(Auth::user()->role->role_permission('view_users'))
									<a href="{{ $leave->user ? asset('/users/'.$leave->user->id) : '' }}">{{ $leave->user ? $leave->user->first_name.' '.$leave->user->last_name : '' }}</a>
								@else
									{{ $leave->user ? $leave->user->first_name.' '.$leave->user->last_name : '' }}
								@endif
								</td>
								<td>{{ $leave->leave_type ? $leave->leave_type->leave_type : '' }}</td>
								<td>{{ $leave->date_from }}</td>
								<td>{{ $leave->date_to }}</td>
								<td>{{ $leave->applied_on }}</td>
								<td>{{ $leave->reason }}</td>
								<td>{{ $leave->comment }}</td>
								<td>
								@if ($leave->status == 'Pending Approval')
										<span class="label label-info">{{ $leave->status }}</span>
								@elseif($leave->status=='Approved')
										<span class="label label-success">{{ $leave->status }}</span>
									@elseif($leave->status=='Rejected')
										<span class="label label-warning">{{ $leave->status }}</span>
								@endif
								</td>

								<td>
									<div class="btn-group">
										@if(Auth::user()->role->role_permission('edit_leaves') || Auth::user()->role->role_permission('process_leave'))
										@if(Auth::user()->role->role_permission('edit_leaves') && $leave->status == 'Pending Approval')

											<a href="{{url('approve-leave/'.$leave->id)}}" class="btn btn-success btn-sm" title="Approve"><i class="fa fa-check"></i></a>
												<a href="{{url('reject-leave/'.$leave->id)}}" class="btn btn-danger btn-sm" title="Reject"><i class="fa fa-repeat"></i></a>

										@endif
										@if(Auth::user()->role->role_permission('delete_leaves') && $leave->status == 'Pending Approval')
										<a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $leave->id }}"><i class="fa fa-trash"></i></a>
										<div id="deleteModal{{ $leave->id }}" class="modal fade" role="dialog">
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
											{!! Form::open(['url' => ['leaves/'.$leave->id], 'method' => 'delete']) !!}
											{!! Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
											{!! Form::close() !!}
											</div>
											</div>
											</div>
										</div>
										@endif
										@endif

										@if($leave->status == 'Pending Approval')
											<a href="{{ asset('leaves/'.$leave->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
                                       @endif
									</div>
								</td>

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
									null,
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
