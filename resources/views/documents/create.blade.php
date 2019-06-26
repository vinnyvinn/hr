@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Documents
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">New Document</h3>
					</div>
					<div class="box-body">
						<form action="{{route('all-documents.store')}}" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
								{!! Form::label('user_id', 'employee') !!}
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
							<div class="form-group{{ $errors->has('document_type_id') || $errors->has('document_type') ? ' has-error' : '' }}">
								{!! Form::label('document_type_id', 'Document Type') !!}<br />
								{!! Form::select('document_type_id', $document_types, null, ['class' => 'form-control']) !!}
								@if ($errors->has('document_type_id') || $errors->has('document_type'))
									<span class="help-block">
			<strong>{{ $errors->has('document_type') ? $errors->first('document_type') : $errors->first('document_type_id') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
								{!! Form::label('document', 'Document') !!}
								<input type="file" name="document" id="document">
								@if ($errors->has('document'))
									<span class="help-block">
			<strong>{{ $errors->first('document') }}</strong>
		</span>
								@endif
							</div>
							<div class="pull-right">
								{!! Form::submit('Save', ['class' => 'btn btn-success btn-flat']) !!}
								<a href="{{ url('/all-documents') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
	<script type="text/javascript">
		$(function () {
			$("select").select2({
				placeholder: "Select",
				allowClear: true
			});
			
			$( "#user" ).autocomplete({
				source: "{{ asset('autocomplete/users')}}",
				minLength: 1,
				select: function(event, ui) {
					$('#employee').val(ui.item.value);
					$('#user_id').val(ui.item.id);
				}
			});
			
			$( "#document_type" ).autocomplete({
				source: "{{ asset('autocomplete/document_types')}}",
				minLength: 1,
				select: function(event, ui) {
					$('#document_type').val(ui.item.value);
					$('#document_type_id').val(ui.item.id);
				}
			});
		});
    </script>
@endsection
