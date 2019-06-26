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
                            <a href="{{ url('offer-template') }}" class="box-title">back</a>
    
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div class="row col-md-8 col-md-offset-2">
                        <form  action="{{ route('offer-template.update',['id' => $letter->id])}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label> Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $letter->title}}">
                            </div>
                            <div class="form-group">
                                <label> Subject</label>
                                <input type="text" name="subject" value="{{ $letter->subject}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> Description</label>
                                 <textarea id="summernote" name="description" class="form-control" rows="8"> {{ $letter->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"> Create Template </button>
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

@section('foot')
<script type="text/javascript" src=" {{asset('note/summernote.min.js')}}"></script>
    <script type="text/javascript">
     $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2, 
            height: 150
        });
      });
    </script>
   
@endsection
