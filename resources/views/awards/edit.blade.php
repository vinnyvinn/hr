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
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">Edit Award</h3>
					</div>
					<div class="box-body">
						<form action="{{route('awards.update',['id' =>$award->id])}}" method="POST">
							{{csrf_field()}}
							{{method_field('PUT')}}
							<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
								{!! Form::label('user_id', 'Employee') !!}
								<select name="user_id" id="user_id" class="form-control">
									@foreach($employees as $empl)
										<option value="{{$empl->id}}" {{$award->user_id == $empl->id ? 'selected="selected"' :''}}>{{$empl->first_name.' '.$empl->last_name}}</option>
									@endforeach
								</select>
								@if ($errors->has('user_id'))
									<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('award_name') ? ' has-error' : '' }}">
								{!! Form::label('award_name', 'Award Name') !!}
								<input type="text" class="form-control" name="award_name" required value="{{$award->award_name}}">
								@if ($errors->has('award_name'))
									<span class="help-block">
			<strong>{{ $errors->first('award_name') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('gift_item') ? ' has-error' : '' }}">
								{!! Form::label('gift_item', 'Gift Item') !!}
								<input type="text" class="form-control" name="gift_item" required value="{{$award->gift_item}}">
								@if ($errors->has('gift_item'))
									<span class="help-block">
			<strong>{{ $errors->first('gift_item') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('cash_price') ? ' has-error' : '' }}">
								{!! Form::label('cash_price', 'Cash Price') !!}
								<input type="text" class="form-control" name="cash_price" required value="{{$award->cash_price}}">
								@if ($errors->has('cash_price'))
									<span class="help-block">
			<strong>{{ $errors->first('cash_price') }}</strong>
		</span>
								@endif
							</div>
							<div class="pull-right">
								{!! Form::submit('Update', ['class' => 'btn btn-success btn-flat']) !!}
								<a href="{{ url('/awards')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
