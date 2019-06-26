@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Candidate
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<h4 class="label label-success"> Personal Information </h4>
				<div class="box box-success">
					<div class="box-header">
						<div class="user-block">
						</div>
					</div>
					<div class="user-block box-body">
						<span class="username no-margin"> 
								Names : {{ $candidate->first_name .' '.$candidate->last_name  }}
							</span>
							<span class="username no-margin">
								Age : {{Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years , %m Months , %d Days ')}}
							</span> 
							
							<span class="username no-margin">
								Email : {{$candidate->email}}
							</span>

							<span class="username no-margin">
								contact : {{$candidate->contact_no}}
							</span> 

							<span class="username no-margin">
								Gender : {{$candidate->gender}}
							</span> 

							<span class="username no-margin">
								Application Date : {{$candidate->application_date}}
							</span> 

					</div>
				</div>
			</div>
</div>
<div class="row">
			<div class="col-md-12">
					<h4 class="label label-success"> Skills &nbsp;&nbsp; & &nbsp;&nbsp; Experience</h4>
				<div class="box box-success">
					<div class="box-header">
						<div class="user-block">
							<span class="username no-margin">Salary : {{ number_format($candidate->salary)}} </span>
							<span class="username no-margin"> Language: {{ $candidate->language }}</span>
						</div>
					</div>
					<div class="box-body user-block">
						<span class="username no-margin">Skills</span>
						{!! $candidate->skills !!}
					</div>

					<div class="box-body user-block">
						<span class="username no-margin">Experience</span>
						{!! $candidate->experience !!}
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4 class="label label-success"> Recruitment Process </h4>
				<div class="box box-success">
					<div class="box-header">
						<div class="user-block">
						</div>
						<div class="box-body">
							<table class="table table-striped ">
								<thead>
									<th>Process (Stage)</th>
									<th>Test Period </th>
									<th>Status</th>
									<th>Comment</th>
									<th>Action</th>
								</thead>
								<tbody>

								@foreach($nextLevel as $nextLevels)
									@foreach($nextLevels->process as $level)
									<tr>
										<td>{{$level->process}}</td>
										<td>{{$level->start_date}} - {{$level->end_date}}</td>
										<td>
										@if($nextLevels->application)
											<label class="label label-success"> {{($nextLevels->application->status)}}
											</label>
											</td>
										@else
										 </td>
										@endif
										<td>{{$nextLevels->comment}}</td>
										<td>
											@if($nextLevels->application && (!isset($nextLevels->esc_status)))
												@include('candidates.updateProcess')
											@endif
										</td>
									</tr>

									@endforeach
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
