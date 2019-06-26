@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1 class="text-center">
		Initiate an Appraisal 
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">First select a questionare template to initiate</h3>
					</div>
					<div class="box-body">
						<form method="post" action="{{ url('finailize-appraisal-activation')}}">
							{{csrf_field()}}
							
							<div class="form-group">
								<label for="questionare_id">Select a Questionare</label>
								<select name="questionare_id" class="form-control" required="true">
									<option selected="true" disabled="true">Select to a questionare</option>
									@foreach($questionares as $questionare)
										<option value="{{$questionare->id}}">{{$questionare->name}}</option>
									@endforeach
								</select>
							</div>

							
							<div class="form-group">
								 <button class="btn btn-success" type="submit">Next <i class="fa fa-arrow-circle-right"></i> </button>
							</div>

							
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection