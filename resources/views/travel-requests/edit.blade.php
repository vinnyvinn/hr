@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Travel Request
			</h1>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Edit Travel Request</h3>
						</div>
						<div class="box-body">
							<form method="POST" action="{{route('travel-request.update',$data->id)}}" accept-charset="UTF-8" id="editForm">
								<input name="_token" type="hidden" value="{{csrf_token()}}">
								{{method_field('PUT')}}
								<div class="form-group">
									<label for="travel_mode">Travel Perdiem</label><br />
									<select required class="form-control" id="travel_perdiem_id" name="travel_perdiem_id">
										@foreach($travelperdiems as $travelperdiem)
											<option value="{{$travelperdiem->id}}" selected="selected">From {{$travelperdiem->from_location}} To {{$travelperdiem->to_location}} - {{$travelperdiem->fare}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="date_from">Date From</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="start_date" type="text" value="{{\Carbon\Carbon::parse($data->date_from)->format('m/d/Y')}}" id="date_from">
									</div>
								</div>
								<input type="hidden" value="{{\Carbon\Carbon::parse($data->date_from)->format('m/d/Y')}}" name="applied_on">
								<div class="form-group">
									<label for="date_to">Date To</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input required class="form-control datepicker" data-inputmask="&#039;alias&#039;: &#039;mm/dd/yyyy&#039;" data-mask="" name="end_date" type="text" value="{{\Carbon\Carbon::parse($data->date_to)->format('m/d/Y')}}" id="end_date">
									</div>
								</div>

								<div class="form-group">
									<label for="reason">Reason</label>
									<input required class="form-control" name="reason" type="text" value="{{$data->reason}}" id="reason">
								</div>

								<div class="pull-right">
									<input class="btn btn-success btn-flat" type="submit" value="Save">
									<a href="{{url('/travel-request')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
	<script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript">
		$(function () {
			$('#editForm').on('submit', function (event) {
				$(this).find('.form-control').removeAttr('disabled');
			});

			$('.datepicker').datepicker({
				autoclose: true
			});
			$("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			$("[data-mask]").inputmask();

			$("select").select2({
				placeholder: "Select",
				allowClear: true
			});

			$( "#leave_type" ).autocomplete({
				source: "{{ asset('autocomplete/leave_types')}}",
				minLength: 1,

				select: function(event, ui) {
					$('#leave_type').val(ui.item.value);
					$('#leave_type_id').val(ui.item.id);
				}
			});
		});
	</script>
@endsection