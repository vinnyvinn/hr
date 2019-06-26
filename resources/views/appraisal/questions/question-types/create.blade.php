@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1 class="text-center">
		Create Question Type
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">New Question Type</h3>
					</div>
					<div class="box-body">
					 <div class="box-body">
                            <form method="POST" action="{{ url('question-types-store') }}" accept-charset="UTF-8" encrypt="multipart/form-data">
                               <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required autofocus type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                	<label for="type_value">Choose an answer type</label> <br>
                                	 <input type="radio" name="type_value" value="{{\App\QuestionType::NUMERIC}}" checked>{{\App\QuestionType::NUMERIC}}<br>
									 <input type="radio" name="type_value" value="{{\App\QuestionType::TEXT}}"> {{\App\QuestionType::TEXT}}<br>
									 <input type="radio" name="type_value" value="{{\App\QuestionType::STARS}}"> {{\App\QuestionType::STARS}} <br>
									 <input type="radio" name="type_value" value="{{\App\QuestionType::TRUE_FALSE}}"> {{\App\QuestionType::TRUE_FALSE}} <br>
                                </div>
                                <div class="form-group">
                                	<input class="btn btn-primary pull-right" type="submit">
                                </div>
                            </form>					
                     </div>
				</div>
			</div>
		</div>
		</div>
	</section>
</div>
@endsection
