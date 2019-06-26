@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Awards
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('alert.success')
				@if(Auth::user()->role->role_permission('create_awards'))
				<a href="{{ asset('/awards/create') }}" type="button" class="btn btn-success btn-flat margin">New Award</a>
				@endif
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Award List</h3>

					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover dataTable">
							<tr>
								<th>ID</th>
								<th>Employee</th>
								<th>Award Name</th>
								<th>Gift Item</th>
								<th>Cash Price</th>
								@if(Auth::user()->role->role_permission('edit_awards') || Auth::user()->role->role_permission('delete_awards'))
								<th>Action</th>
								@endif
							</tr>
							@foreach($awards as $award)
							<tr>
								<td>{{ $award->id }}</td>
								<td>
									<a href="{{ $award->user ? asset('/users/'.$award->user->id) : '' }}"></a>{{ $award->user ? $award->user->first_name.' '.$award->user->last_name : '' }}
								</td>
								<td>{{ $award->award_name }}</td>
								<td>{{ $award->gift_item }}</td>
								<td>{{ $award->cash_price }}</td>
								@if(Auth::user()->role->role_permission('edit_awards') || Auth::user()->role->role_permission('delete_awards'))
								<td>
									<div class="btn-group">
										@if(Auth::user()->role->role_permission('edit_awards'))
										<a href="{{ asset('awards/'.$award->id.'/edit') }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
										@endif
										@if(Auth::user()->role->role_permission('delete_awards'))
										<a type="button" class="btn btn-default btn-flat btn-sm" title="Delete" data-toggle="modal" data-target="#deleteModal{{ $award->id }}"><i class="fa fa-trash"></i></a>
										<div id="deleteModal{{ $award->id }}" class="modal fade" role="dialog">
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
											{!! Form::open(['url' => ['awards/'.$award->id], 'method' => 'delete']) !!}
											{!! 	Form::submit('Yes', ['class' => 'btn btn-success btn-flat']) !!}
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
					<div class="box-footer clearfix">
						<div class="row">
							<div class="col-xs-12">
								Showing {{ $awards->firstItem() }} to {{ $awards->lastItem() }} of {{ $awards->total() }} entries
								<div class="pull-right">
								{!! $awards->links() !!}
								</div>
							</div>
						</div>
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

