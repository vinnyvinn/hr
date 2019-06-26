@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Designation Items
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">Edit Designation Item</h3>
					</div>
					<div class="box-body">
						<form action="{{route('designation-items.update',['id' => $designation_item->id])}}" method="POST">
							{{csrf_field()}}
							{{method_field('PUT')}}
						{!! Form::hidden('id', $designation_item->id) !!}
						@if(isset($department) && $department->count() == 0)
							<div class="form-group">
								{!! Form::label('department_id', 'user') !!}
								<input type="text" value="{{$designation_item->department->department}}">
								{!! Form::hidden('department_id', $department->id) !!}
							</div>
						@else
							<div class="form-group{{ $errors->has('department_id') || $errors->has('department') ? ' has-error' : '' }}">
								{!! Form::label('department_id', 'Department') !!}<br />
								<select name="department_id" id="department_id" class="form-control">
									@foreach($departments as $dept)
										<option value="{{$dept->id}}" {{$dept->id ==$designation_item->department->id ? 'selected="selected"': ''}}>{{$dept->department}}</option>
								 @endforeach
								</select>
								@if ($errors->has('department_id') || $errors->has('department'))
									<span class="help-block">
			<strong>{{ $errors->has('department') ? $errors->first('department') : $errors->first('department_id') }}</strong>
		</span>
								@endif
							</div>
						@endif
						<div class="form-group{{ $errors->has('designation_item') ? ' has-error' : '' }}">
							{!! Form::label('designation_item', 'Designation Item') !!}
							<input type="text" value="{{$designation_item->designation_item}}" name="designation_item" class="form-control">
							@if ($errors->has('designation_item'))
								<span class="help-block">
			<strong>{{ $errors->first('designation_item') }}</strong>
		</span>
							@endif
						</div>
						<div class="pull-right">
							{!! Form::submit('Update', ['class' => 'btn btn-success btn-flat']) !!}
							<a href="{{ url('/designation-items') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
	<script type="text/javascript">
		$(function () {
			$("select").select2({
				placeholder: "Select",
				allowClear: true
			});
		});
    </script>
@endsection
