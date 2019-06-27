@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Import Employees
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Employees </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('import-employees')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="users">Upload Excel File</label>
                                    <input type="file" name="users" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Import" class="btn btn-success">

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('foot')
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>


    <script>


        $('.staff').select2();

    </script>

@endsection

