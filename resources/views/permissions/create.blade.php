@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
               New Permission
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
                            <form action="{{route('permissions.store')}}" method="POST">
                                {{csrf_field()}}
                                
                                <div class="form-group">
                                    <label for="permission">Name</label>
                                    <input type="text" name="permission" placeholder="permission_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="label">Label</label>
                                    <input type="text" name="label" placeholder="permission name" class="form-control" required>
                                </div>
                                <input type="hidden" name="level" value="1">



                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-success">
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


