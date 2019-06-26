@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Expenses
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">New Expense</h3>
					</div>
					<div class="box-body">
						<form action="{{route('expenses.store')}}" method="POST">
							{{csrf_field()}}

							<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
								{!! Form::label('user_id', 'Employee') !!}
								<select name="user_id" id="user_id" class="form-control">
									@foreach($employees as $empl)
										<option value="{{$empl->id}}">{{$empl->first_name .' '.$empl->last_name}}</option>
								  @endforeach
								</select>
								@if ($errors->has('user_id'))
									<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('item_name') ? ' has-error' : '' }}">
								{!! Form::label('item_name', 'Item Name') !!}
								<input type="text" class="form-control" name="item_name" id="item_name">
								@if ($errors->has('item_name'))
									<span class="help-block">
			<strong>{{ $errors->first('item_name') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('purchase_from') ? ' has-error' : '' }}">
								{!! Form::label('purchase_from', 'Purchase From') !!}
								<input type="text" class="form-control" name="purchase_from" id="purchase_from">
								@if ($errors->has('purchase_from'))
									<span class="help-block">
			<strong>{{ $errors->first('purchase_from') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('purchase_date') ? ' has-error' : '' }}">
								{!! Form::label('purchase_date', 'Purchase Date') !!}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control datepicker" name="purchase_date" id="purchase_date">

								</div>
								@if ($errors->has('purchase_date'))
									<span class="help-block">
			<strong>{{ $errors->first('purchase_date') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
								{!! Form::label('amount', 'Amount') !!}
								<input type="number" class="form-control" step="0.001" name="amount" id="amount">
								@if ($errors->has('amount'))
									<span class="help-block">
			<strong>{{ $errors->first('amount') }}</strong>
		</span>
								@endif
							</div>
							<div class="pull-right">
								{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
								<a href="{{ url('/expenses') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript">
		$(function () {
			$('.datepicker').datepicker({
				autoclose: true,
				endDate:'-1d'
			});
			$("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			$("[data-mask]").inputmask();
			
			$( "#employee" ).autocomplete({
				source: "{{ asset('autocomplete/users')}}",
				minLength: 1,
				select: function(event, ui) {
					$('#employee').val(ui.item.value);
					$('#user_id').val(ui.item.id);
				}
			});
		});
    </script>
@endsection
