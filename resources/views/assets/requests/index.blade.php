@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>


@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Request Asset
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Request Asset </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('request-save')}}" method="POST">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="user_id">Staff</label>
                                    <select name="user_id" id="user_id" class="form-control staff" required>
                                        @foreach($users as $staff)
                                            <option value="{{$staff->id}}">{{$staff->first_name.' '.$staff->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="asset_id">Asset</label>
                                    <select name="asset_id" id="asset_id" class="form-control staff" required>
                                        @foreach($assets as $asset)
                                            <option value="{{$asset->id}}">{{$asset->make .'/'.$asset->model .'/'.$asset->asset_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="req_date">Request date</label>
                                    <input type="text" class="form-control" name="req_date" id="req_date" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Request Asset" class="btn btn-success">
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
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>


    <script>


        $('.staff').select2();
        $('#req_date').datepicker();

    </script>

@endsection

