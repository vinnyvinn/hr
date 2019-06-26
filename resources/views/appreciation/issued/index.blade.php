@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Letters
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
                            <h3 class="box-title">Issued List</h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Title</th>
                                    <th>Subject</th>
                                    <th>Body</th>
                                    <th>Action</th>
                                </tr>
                                @php($count =1 )
                                @foreach($appreciations as $appreciation)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $appreciation->user ? $appreciation->user->first_name.' '.$appreciation->user->last_name :''}}</td>
                                        <td>{{ $appreciation->title }}</td>
                                        <td>{{ $appreciation->subject }}</td>
                                        <td>{!! $appreciation->description !!}</td>
                                        <td><a href="{{ url('print-appreciation',['id'=>$appreciation->id]) }}" class="btn btn-xs btn-success fa fa-print"> Print</a></td>
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
