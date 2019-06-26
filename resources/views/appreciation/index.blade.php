@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Appreciation
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    @if(Auth::user()->role->role_permission('create_leaves'))
                        <a href="{{ asset('appreciation/create') }}" type="button" class="btn btn-success btn-flat margin">New Template </a>
                        <a href="{{ url('issued-appreciation') }}" type="button" class="btn btn-success btn-flat margin">Issued Appreciation </a>
                    @endif
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Template List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Subject</th>
                                    <th>Body</th>
                                    <th class="">Action</th>
                                </tr>
                                @php($count =1 )
                                @foreach($appreciations as $appreciation)
                                    <tr>
                                        
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $appreciation->title }}</td>
                                        <td>{{ $appreciation->subject }}</td>
                                        <td>{!! $appreciation->description !!}</td>
                                        <td>
                                        <a href="{{ url('appreciation',['id'=>$appreciation->id])}}" class="btn btn-success btn-xs"> issue</a>

                                        <form method="POST" action="{{ url('appreciation',['id'=>$appreciation->id])}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                           <button class="btn btn-danger btn-xs fa fa-trash">
                                           </button>
                                        </form>

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
        </section>
    </div>
@endsection