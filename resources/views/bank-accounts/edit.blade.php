@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Bank Accounts
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">Edit Bank Account</h3>
					</div>
					<div class="box-body">
						<form action="{{url('bank-accounts',['id' =>$bank_account->id])}}" method="POST">
						{{csrf_field()}}
						{{method_field('PUT')}}
						{!! Form::hidden('id', $bank_account->id) !!}
						<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
							<label for="user_id">Employee</label>
							<select name="user_id" id="user_id" class="form-control" required>
								@foreach($employees as $emp)
									<option value="{{$emp->id}}" {{$bank_account->user_id ==$emp->id ? 'selected="selected"' : ''}}>{{$emp->first_name .' '.$emp->last_name}}</option>
								@endforeach
							</select>
							@if ($errors->has('user_id'))
								<span class="help-block">
			<strong>{{ $errors->first('user_id') }}</strong>
		</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
							{!! Form::label('account_name', 'Account Name') !!}
							<select name="account_name" id="account_name" class="form-control" required>
								@foreach($employees as $emp)
									<option value="{{$emp->first_name .' '.$emp->last_name}}">{{$emp->first_name .' '.$emp->last_name}}</option>
								@endforeach
							</select>
							@if ($errors->has('account_name'))
								<span class="help-block">
			<strong>{{ $errors->first('account_name') }}</strong>
		</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
							{!! Form::label('account_number', 'Account Number') !!}
							<input type="text" name="account_number" class="form-control" value="{{$bank_account->account_number}}" required>
							@if ($errors->has('account_number'))
								<span class="help-block">
			<strong>{{ $errors->first('account_number') }}</strong>
		</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
							{!! Form::label('bank_name', 'Bank Name') !!}
							<input type="text" name="bank_name" class="form-control" value="{{$bank_account->bank_name}}" required>
							@if ($errors->has('bank_name'))
								<span class="help-block">
			<strong>{{ $errors->first('bank_name') }}</strong>
		</span>
							@endif
						</div>
							<div class="form-group{{ $errors->has('bank_code') ? ' has-error' : '' }}">
								{!! Form::label('bank_code', 'Bank Code') !!}
								<input type="text" name="bank_code" class="form-control" value="{{$bank_account->bank_code}}" required>
								@if ($errors->has('bank_code'))
									<span class="help-block">
			<strong>{{ $errors->first('bank_code') }}</strong>
		</span>
								@endif
							</div>
							<div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
								{!! Form::label('branch_name', 'Branch Name') !!}
								<input type="text" name="branch_name" class="form-control" value="{{$bank_account->branch_name}}" required>
								@if ($errors->has('branch_name'))
									<span class="help-block">
			<strong>{{ $errors->first('branch_name') }}</strong>
		</span>
								@endif
							</div>

							<div class="form-group{{ $errors->has('branch_code') ? ' has-error' : '' }}">
								{!! Form::label('branch_code', 'Branch Code') !!}
								<input type="text" name="branch_code" class="form-control" value="{{$bank_account->branch_code}}" required>
								@if ($errors->has('branch_code'))
									<span class="help-block">
			<strong>{{ $errors->first('branch_code') }}</strong>
		</span>
								@endif
							</div>
						<div class="pull-right">
							{!! Form::submit('Update', ['class' => 'btn btn-success btn-flat']) !!}
							<a href="{{ isset($user->id) ? asset('/users/'.$user->id) : asset('/bank-accounts') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
						</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
