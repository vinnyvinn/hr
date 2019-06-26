@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Modify Permission
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">  </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('permissions.update',['id' =>$permission->id])}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label for="permission">Name</label>
                                    <input type="text" name="permission" value="{{$permission->permission}}" placeholder="permission_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="label">Label</label>
                                    <input type="text" name="label" placeholder="permission name" value="{{$permission->label}}" class="form-control" required>
                                </div>


                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-success">
                                    <a href="{{url('/permissions')}}" class="btn btn-default">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


