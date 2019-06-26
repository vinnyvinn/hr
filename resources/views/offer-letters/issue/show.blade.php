@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<!-- Include Editor style. -->
@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Edit a new Offer Letter template
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="box box-success">
                        <div class="box-header">
    
                        </div>
                        <div class="box-body table-responsive no-padding">
                    <div class="row col-md-8 col-md-offset-2">
	<H4> Your are about to make an offer to  <label class="label label-success">{{ $candidate->first_name.' '.$candidate->last_name}} </label> @  <label class="label label-success">{{$candidate->email}}</label></H4>
                            
                            <form method="POST" action="{{ url( 'offer-letter')}}" enctype="multipart/form-data">
                            	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            	<input type="hidden" name="id" value="{{$candidate->id}}">
                            	<div class="form-group">
                            		<label>Select Offer template</label>
                            		<select name="offer_template" class="form-control">
                            				@foreach($templates as $template)
												<option value="{{ $template->id}}"> {{$template->title}} </option>		
                            				@endforeach
                            		</select>
                            	</div>

                            	<div class="form-group">
                            			<label> Make attachments</label>
										<input type="file" name="attachments">
                            	</div>
								<div class="form-group">
									<button class="btn btn-success"> make offer</button>
								</div>
                            </form>
                       </div>
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
        </section>
    </div>
@endsection
