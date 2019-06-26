@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<!-- Include Editor style. -->
@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Create a new warning template
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-success">
                        <div class="box-header">
                            <a href="{{ url('warning') }}" class="box-title">back</a>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div class="row col-md-8 col-md-offset-2">
                        <form  action="{{ url('warning')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label> Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> Subject</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> Description</label>
                                 <textarea id="summernote" name="description" class="form-control" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Document</label>
                                <input type="file" name="document" id="document">
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
    <script src="{{asset('/dist/js/summernote-bs4.js')}}"></script>
    <script type="text/javascript">
     $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2,
            height: 150
        });
      });
    </script>

@endsection
