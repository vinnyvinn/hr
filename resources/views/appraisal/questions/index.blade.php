@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Appraisal Questions Types
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				@include('alert.success')
			
				<a href="{{ asset('/appraisal-questions/create') }}" type="button" class="btn btn-success btn-flat margin">New Question</a>
				
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Question Types</h3>
						
					</div>
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>Question</th>
								<th>Question Type</th>

								<th>Action</th>
								
							</tr>
							@foreach($questions as $question )
							<tr>
								<td>{{ $question->id }}</td>
								<td><a href=""></a>{{ $question->question }}</td>

								<td>
									@foreach($question_types as $type)
										{{ $type->id == $question->question_type_id ? $type->name : ''}}
									@endforeach
								</td>
								<td>

									<div class="btn-group">


										<a href="{{ url('quiz/app/'.$question->id) }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-pencil"></i></a>
										<a href="{{ url('quiz/remove/'.$question->id) }}" title="Edit" class="btn btn-default btn-flat btn-sm"><i class="fa fa-trash"></i></a>




									</div>

								</td>

							</tr>
							@endforeach
						</table>
					</div>
					<div class="box-footer clearfix">
						<div class="row">
							<div class="col-xs-12">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
