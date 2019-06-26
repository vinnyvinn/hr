@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

@section('head')
   <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
             Asset
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Asset </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('assets.store')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="make">Make</label>
                                    <input type="text" class="form-control" name="make" id="make" required>
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" name="model" id="model" required>
                                </div>
                                <div class="form-group">
                                    <label for="asset_type_id">Type</label>
                                    <select name="asset_type_id" id="asset_type_id" class="form-control asset">
                                        @foreach($asset_types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="serial_no">Serial Number</label>
                                    <input type="text" class="form-control" name="serial_no" id="serial_no" required>
                                </div>
                                <div class="form-group">
                                    <label for="part_no">Part Number</label>
                                    <input type="text" class="form-control" name="part_no" id="part_no" required>
                                </div>
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" class="form-control" name="color" id="color" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Save Asset" class="btn btn-success">
                                    <a href="{{url('/assets')}}" class="btn btn-default">Cancel</a>
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


        $('.asset').select2();

    </script>

@endsection

