@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Leave Types
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">New Leave Type</h3>
					</div>
					<div class="box-body">
						<form action="{{url('leave-types')}}" method="post">
                            {{csrf_field()}}
						@include('leave-types.form')
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('scripts')
	<script>

        $('#staffs').select2();

	</script>

	@endsection

