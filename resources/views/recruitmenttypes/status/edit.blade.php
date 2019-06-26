@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<!-- Include Editor style. -->
@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Create a new Appreciation template
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="box box-success">
                        <div class="box-header">
                            <a href="{{ url('application-status') }}" class="box-title">back</a>
    
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div class="row col-md-8 col-md-offset-2">
                        <form  action="{{ url('application-status/'.$status->id)}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT" >
                            <div class="form-group">
                                <label> Status</label>
                                <input type="text" name="status" class="form-control" value="{{$status->status}}">
                            </div>
                            <div class="form-group">
                                <label> Descriptiom</label>
                                 <textarea name="description" class="form-control" rows="8"> {{$status->description}}</textarea>
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