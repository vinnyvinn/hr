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
			<div class="col-md-10 col-md-offset-1">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">New Candidate</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['url' => 'candidates', 'files' => 'true']) !!}
						@include('candidates.form')
						{!! Form::close() !!}
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
