@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/iCheck/square/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Terminate Contract
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Terminate Contract </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('update-contract')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="gross_amount">Select Staff</label>
                                    <select name="user_id[]" id="user_id" class="form-control staff" multiple required>
                                        @foreach($users as $staff)
                                            <option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="termination_date">Termination Date</label>
                                    <input type="text" name="termination_date" class="form-control datepicker" required>
                                </div>

                                    <div class="form-group">
                                        <label for="reason">Reason for Cancellation</label>
                                        <select name="reason" class="form-control select2" style="width: 90% !important;" required>
                                            @foreach($reasons as $r)
                                                <option value="{{$r->id}}">{{$r->reason}}</option>
                                            @endforeach
                                        </select>
                                        <a href="#" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus">Add more</i></a>
                                </div>


                                 

                                <div class="form-group">
                                    <input type="submit" value="Terminate Contract" class="btn btn-success" id="template">
                                    <a href="{{url('/contracts')}}" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Reasons For Cancellation Form</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('add-reason')}}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="reason">Enter Reason</label>
                                                    <input type="text" name="reason" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>

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
    <script src="{{ asset('/plugins/iCheck/icheck.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <script>
        $(document).ready(function () {

$('.datepicker').datepicker();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        });

        $(function () {
            $('.staff,.select2').select2();
        });
        $("#expiry_date").datepicker();


    </script>

@endsection

