@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>
<link href="{{asset('dist/css/selector2.min.css')}}" rel="stylesheet" />
<script src="{{asset('dist/js/selector2.min.js')}}"></script>

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Modify Sub-Department
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Modify Sub-Department </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('update-sub')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$sub_department->id}}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$sub_department->name}}" placeholder="enter name" required>
                                </div>
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="department_id" class="form-control" required>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$sub_department->department_id==$department->id ? 'selected="selected"' : ''}}>{{$department->department}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                    <a href="{{url('/departments')}}" class="btn btn-default">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script type="text/javascript">
    $("#department_id").select2();


</script>
