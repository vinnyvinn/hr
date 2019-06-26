@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<!-- Include Editor style. -->
@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Appreciations
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="box box-success">
                        <div class="box-header">
                            <a href="{{url('appreciation') }}" class="btn btn-success">back</a>
    
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div class="row col-md-8 col-md-offset-2">
                        <form  action="{{ url('appreciation-send')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for=""> Send To</label>
                                <select class="form-control" name="id">
                                    @foreach($users as $user)
                                        <option value="{{$user->id }}"> {{ $user->first_name ." ".$user->last_name}}</option>
                                    @endforeach()
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $appreciationTemp->title}} ">
                            </div>
                            <div class="form-group">
                                <label> Subject</label>
                                <input type="text" name="subject" class="form-control" value="{{ $appreciationTemp->subject}}" />
                            </div>
                            <div class="form-group">
                                <label> Description</label>
                                 <textarea  name="description" class="form-control" rows="8" value="{{ $appreciationTemp->description}}" id="summernote"></textarea>
                            </div>
                            <div class="row form-group ">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block fa fa-send" name="issue" value="issue"> Issue Warning </button>
                                </div>
                                <div class="col-md-6">
                                 <button type="submit" class="btn btn-info btn-block fa fa-envelope" name="mail" value="mail"> Issue Warning & Mail </button>
                                </div>
                                
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
            height: 150,
            code: 'hello world'
        });
        $('#summernote').summernote('code', '<?php echo $appreciationTemp->description ?>');

      });
    </script>
   
@endsection