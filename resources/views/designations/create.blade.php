@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Designations
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">New Designation</h3>
					</div>
					<div class="box-body">
						<form action="{{route('designations.store')}}" method="POST">
							{{csrf_field()}}

							<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
								{!! Form::label('user_id', 'user') !!}
								<select name="user_id" id="user_id" class="form-control">
									@foreach($employees as $staff)
										<option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
										@endforeach
								</select>

								@if ($errors->has('user_id'))
									<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('designation_item_id') || $errors->has('designation_item') ? ' has-error' : '' }}">
								<select name="designation_item_id" id="designation_item_id"class="form-control">
									@foreach($designation_items as $desig)
										<option value="{{$desig->id}}">{{$desig->designation_item}}</option>
										@endforeach
								</select>
								@if ($errors->has('designation_item_id') || $errors->has('designation_item'))
									<span class="help-block">
			<strong>{{ $errors->has('designation_item') ? $errors->first('designation_item') : $errors->first('designation_item_id') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('date_start') ? ' has-error' : '' }}">
								{!! Form::label('date_start', 'Date Start') !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('date_start', null, ['class' => 'form-control datepicker', 'data-inputmask' => "'alias': 'mm/dd/yyyy'", 'data-mask' => '']) !!}
								</div>
								@if ($errors->has('date_start'))
									<span class="help-block">
			<strong>{{ $errors->first('date_start') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
								{!! Form::label('date_end', 'Date End') !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{!! Form::text('date_end', null, ['class' => 'form-control datepicker', 'data-inputmask' => "'alias': 'mm/dd/yyyy'", 'data-mask' => '']) !!}
								</div>
								@if ($errors->has('date_end'))
									<span class="help-block">
			<strong>{{ $errors->first('date_end') }}</strong>
		</span>
								@endif
							</div>


							<div class="pull-right">
								{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
								<a href="{{ asset('/designations') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
	<script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
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
			
			$( "#employee" ).autocomplete({
				source: "{{ asset('autocomplete/users')}}",
				minLength: 1,
				select: function(event, ui) {
					$('#employee').val(ui.item.value);
					$('#user_id').val(ui.item.id);
				}
			});
			
			$( "#designation_item" ).autocomplete({
				source: "{{ asset('autocomplete/designation_items')}}",
				minLength: 1,
				select: function(event, ui) {
					$('#designation_item').val(ui.item.value);
					$('#designation_item_id').val(ui.item.id);
				}
			});
		});
    </script>
@endsection
