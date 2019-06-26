@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

<link href="{{ asset('css/preview.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1 class="text-center">
		Perform Appraisal 
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Perform Appraisal</h3>
						<h5>You can click on <b>save</b> and come back later to continue with the appraisal, but once you click <b>finish</b> you cannot continue , the appraisal will be automatically submitted</h5>
					</div>
					<div class="box-body">
						<form method="post" action="{{ url('process-appraisal') }}">

							{{csrf_field()}}
							<input type="hidden" name="active_id" value="{{ $id}}">
							<div class="form-group">

								@foreach($questions as $question)

								   <b> {{$question->question}} </b><br>
								  <?php $type = App\QuestionType::findorFail($question->question_type_id); ?>
								   @if($type->type_value == 1)
								   		<input class="form-control" type="number" name="{{$question->id}}">
								   @endif
								    @if($type->type_value == 2)
								   		<input class="form-control" type="text" name="{{$question->id}}">
								   @endif
								   
								    @if($type->type_value == 3)
								     <input id="input-1" name="{{$question->id}}" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="1" data-size="xs">
								   		 
								   @endif
								   @if($type->type_value == 4)
								   		<input type="radio" name="{{$question->id}}" value="true">True
								   		<input type="radio" name="{{$question->id}}" value="false">False

								   @endif
								   <hr>
								@endforeach
							</div>

							<div class="form-group">
								 <button class="btn btn-success pull-right" style="margin-left: 20px;" type="submit" name="finalize">Finish <i class="fa fa-arrow-circle-right"></i> </button>

								 <button class="btn btn-success pull-right" type="submit" name="save">Save <i class="fa fa-arrow-circle-right"></i> </button>
								
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
<script type="text/javascript">

    $("#input-id").rating();

</script>
@endsection
