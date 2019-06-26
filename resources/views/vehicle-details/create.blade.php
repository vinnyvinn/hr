@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Vehicle Details
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Vehicle Detail </h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('vehicle-details.store')}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label for="user_id">Name</label>
                                    <select style="width: 100%" name="user_id" id="user_id" required class="form control">
                                        <option value="">Select employee</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}} - {{$user->employee_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_type">Vehicle type</label>
                                    <input required  type="text" class="form-control" id="vehicle_type" name="vehicle_type">
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_number">Vehicle number</label>
                                    <input required  type="text" class="form-control" id="vehicle_number" name="vehicle_number">
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_model">Vehicle model name</label>
                                    <input required  type="text" class="form-control" id="vehicle_model" name="vehicle_model">
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_purchase_date">Vehicle purchase date</label>
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input required  type="text" class="form-control datepicker" data-inputmask="'alias':'mm/dd/yyyy'" id="vehicle_purchase_date" data-mask name="vehicle_purchase_date">
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_description">Vehicle description</label>
                                    <input required  type="text" class="form-control" id="vehicle_description" name="vehicle_description">
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{url('/vehicle-details')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('.datepicker').datepicker({
                autoclose: true,
            });
            $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            $("[data-mask]").inputmask();

            $("select").select2({
                placeholder: "Select",
                allowClear: true
            });
                 });
    </script>
@endsection