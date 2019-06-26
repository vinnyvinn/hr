@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

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
                Contract Template
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Contract Template </h3>
                        </div>
                        <div class="box-body">
                            <form class="contract_template">
                                {{csrf_field()}}
                                <div class="form-group">

                                    <label for="name">name</label>
                                    <input type="text" class="form-control" name="name" placeholder="enter name"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="start_date"
                                           placeholder="enter start date" id="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control datepicker" name="duration"
                                           placeholder="enter duration" id="duration" required>
                                </div>

                                <div class="form-group">
                                    <h4>Contract Parameters</h4>
                                    <input type="radio" name="contract_parameter"
                                           value="{{\Vinn\Constants\Helper::NON_RENEWABLE}}" class="contract_parameter">
                                    <label class="margin">Non-renewable</label>


                                    <input type="radio" name="contract_parameter"
                                           value="{{\Vinn\Constants\Helper::RENEWABLE}}" class="contract_parameter">
                                    <label class="margin">Renewable</label>
                                    <br>
                                    <span id="help_contract_parameter"></span>
                                </div>
                                <div class="form-group">
                                    <h4>Contract Type</h4>

                                    <input type="radio" name="contract_type"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_EMPLOYMENT}}"
                                           class="contract_type">
                                    <label class="margin">Employment</label>

                                    <input type="radio" name="contract_type"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_LABOUR}}" class="contract_type">
                                    <label class="margin">Labour</label>

                                    <input type="radio" name="contract_type"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_CONSULTANCY}}"
                                           class="contract_type">
                                    <label class="margin">Consultancy</label>
                                    <br>
                                    <span id="help_contract_type"></span>
                                </div>
                                <div class="form-group contract_basis">
                                    <h4>Payment</h4>


                                    <input type="radio" name="payment"
                                           value="{{\Vinn\Constants\Helper::CONTACT_TYPE_PAID}}" class="payment">
                                    <label class="margin">Paid</label>
                                    <input type="radio" name="payment"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_TYPE_NON_PAID}}" class="payment">
                                    <label class="margin">Non-paid</label>
                                    <br>
                                    <span id="help_payment"></span>

                                </div>
                                <div class="form-group contract_basis">
                                    <h4>Payment Frequency</h4>

                                    <input type="radio" name="payment_frequency"
                                           value="{{\Vinn\Constants\Helper::PAY_DAILY}}" class="payment_frequency">
                                    <label class="margin">Daily</label>

                                    <input type="radio" name="payment_frequency"
                                           value="{{\Vinn\Constants\Helper::PAY_WEEKLY}}" class="payment_frequency">
                                    <label class="margin">Weekly</label>

                                    <input type="radio" name="payment_frequency"
                                           value="{{\Vinn\Constants\Helper::PAY_MONTHLY}}" class="payment_frequency">
                                    <label class="margin">Monthly</label>
                                    <br>
                                    <span id="help_payment_frequency"></span>
                                </div>
                                <div class="form-group contract_basis">
                                    <label for="gross_amount">Gross Pay-out Amount</label>
                                    <input type="number" class="form-control" step="0.001" name="gross_amount"
                                           placeholder="enter amount">
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Save Template" class="btn btn-success" id="template">
                                    <a href="{{url('/contract-template')}}" class="btn btn-default">Cancel</a>
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
    <script src="{{ asset('/plugins/iCheck/icheck.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <script>
        var employment = '';

        $(".contract_type").on("ifChecked", function () {
            employment=$(this).val();
            if(employment=='Employment'){
                $('.contract_basis').hide();

            }
            else {
                $('.contract_basis').show();
            }
        });

        $(document).ready(function () {


            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        });



                $('.contract_template').on('submit', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var contract_parameter = $('.contract_parameter').is(':checked');
                    var contract_type = $('.contract_type').is(':checked');
                    var payment = $('.payment').is(':checked');
                    var payment_frequency = $('.payment_frequency').is(':checked');
                    if (!contract_parameter) {

                        $('#help_contract_parameter').html('Contract Parameter is required').css('color', 'red');
                    } else {
                        $('#help_contract_parameter').html('');
                    }

                    if (!contract_type) {
                        $('#help_contract_type').html('Contract Type field is required').css('color', 'red');
                    } else {
                        $('#help_contract_type').html('');
                    }

                    if (!payment) {
                        $('#help_payment').html('Payment field is required').css('color', 'red');
                    } else {
                        $('#help_payment').html('');
                    }
                    if (!payment_frequency) {
                        $('#help_payment_frequency').html('Payment frequency field is required').css('color', 'red');
                    } else {
                        $('#help_payment_frequency').html('');
                    }


                    $.ajax({
                        url:'{{route('contract-template.store')}}',
                        data: $(this).serialize(),
                        type:'POST',
                        success : function (data) {
                            console.log(data);
                            window.location.href='{{url('/contract-template')}}';
                            {{--///window.location.href='{{url('/contract-template')}}';--}}

                        }
                    });


                })




        $(".datepicker").datepicker();
    </script>

@endsection

