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
                Modify Contract Template
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Modify Contract Template </h3>
                        </div>
                        <div class="box-body">
                            <form class="contract_template">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$contract->id}}" id="temp_id">
                                <div class="form-group">

                                    <label for="name">name</label>
                                    <input type="text" class="form-control" name="name" placeholder="enter name"
                                           required value="{{$contract->name}}" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="start_date" value="{{$contract->start_date}}"
                                           placeholder="enter start date" id="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control datepicker" name="duration"
                                           placeholder="enter duration" id="duration" required value="{{$contract->duration}}" id="duration">
                                </div>

                                <div class="form-group">
                                    <h4>Contract Parameters {{$contract->contract_parameter}}</h4>
                                    <input type="radio" name="contract_parameter"
                                           value="{{\Vinn\Constants\Helper::NON_RENEWABLE}}"{{$contract->contract_parameter ==\Vinn\Constants\Helper::NON_RENEWABLE ? 'checked="checked"' : ''}} class="contract_parameter">
                                    <label class="margin">Non-renewable</label>


                                    <input type="radio" name="contract_parameter"
                                           value="{{\Vinn\Constants\Helper::RENEWABLE}}"{{$contract->contract_parameter==\Vinn\Constants\Helper::RENEWABLE ? 'checked="checked"' : ''}} class="contract_parameter">
                                    <label class="margin">Renewable</label>
                                    <br>
                                    <span id="help_contract_parameter"></span>
                                </div>
                                <div class="form-group">
                                    <h4>Contract Type</h4>

                                    <input type="radio" name="contract_type"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_EMPLOYMENT}}"{{$contract->contract_type==\Vinn\Constants\Helper::CONTRACT_EMPLOYMENT ? 'checked="checked"' : ''}}
                                           class="contract_type">
                                    <label class="margin">Employment</label>

                                    <input type="radio" name="contract_type"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_LABOUR}}"{{$contract->contract_type==\Vinn\Constants\Helper::CONTRACT_LABOUR ? 'checked="checked"' :''}} class="contract_type">
                                    <label class="margin">Labour</label>

                                    <input type="radio" name="contract_type"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_CONSULTANCY}}"{{$contract->contract_type==\Vinn\Constants\Helper::CONTRACT_CONSULTANCY ? 'checked="checked"' : ''}}
                                           class="contract_type">
                                    <label class="margin">Consultancy</label>
                                    <br>
                                    <span id="help_contract_type"></span>
                                </div>
                                <div class="form-group contract_basis">
                                    <h4>Payment</h4>


                                    <input type="radio" name="payment"
                                           value="{{\Vinn\Constants\Helper::CONTACT_TYPE_PAID}}"{{$contract->payment==\Vinn\Constants\Helper::CONTACT_TYPE_PAID ? 'checked="checked"' : ''}} class="payment">
                                    <label class="margin">Paid</label>
                                    <input type="radio" name="payment"
                                           value="{{\Vinn\Constants\Helper::CONTRACT_TYPE_NON_PAID}}"{{$contract->payment==\Vinn\Constants\Helper::CONTRACT_TYPE_NON_PAID ? 'checked="checked"' : ''}} class="payment">
                                    <label class="margin">Non-paid</label>
                                    <br>
                                    <span id="help_payment"></span>

                                </div>
                                <div class="form-group contract_basis">
                                    <h4>Payment Frequency</h4>

                                    <input type="radio" name="payment_frequency"
                                           value="{{\Vinn\Constants\Helper::PAY_DAILY}}"{{$contract->payment_frequency ==\Vinn\Constants\Helper::PAY_DAILY ? 'checked="checked"' : ''}} class="payment_frequency">
                                    <label class="margin">Daily</label>

                                    <input type="radio" name="payment_frequency"
                                           value="{{\Vinn\Constants\Helper::PAY_WEEKLY}}"{{$contract->payment_frequency==\Vinn\Constants\Helper::PAY_WEEKLY ? 'checked="checked"' : ''}} class="payment_frequency">
                                    <label class="margin">Weekly</label>

                                    <input type="radio" name="payment_frequency"
                                           value="{{\Vinn\Constants\Helper::PAY_MONTHLY}}"{{$contract->payment_frequency==\Vinn\Constants\Helper::PAY_MONTHLY ? 'checked="checked"' : ''}} class="payment_frequency">
                                    <label class="margin">Monthly</label>
                                    <br>
                                    <span id="help_payment_frequency"></span>
                                </div>
                                <div class="form-group contract_basis">
                                    <label for="gross_amount">Gross Pay-out Amount</label>
                                    <input type="number" class="form-control" step="0.001" name="gross_amount"
                                           placeholder="enter amount"  value="{{$contract->gross_amount}}" id="amount">
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Update Template" class="btn btn-success" id="template" data-token="{{ csrf_token() }}">
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
            // if($('.contract_type').val() =='Employment'){
            //     $('.contract_basis').hide();
            // }

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        });

        $(function () {

            var temp_id = $('#temp_id').val();

            $('#template').on('click', function () {


                $('.contract_template').on('submit', function (e) {
                    e.preventDefault();

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

                   var myurl = '{{url("contract-template")}}'+'/'+temp_id;

                   console.log($(this).serialize());
                    $.ajax({
                        url:myurl,
                        data: $(this).serialize(),
                        type:'PUT',
                        success : function (data) {
                            console.log(data);
                            window.location.href='{{url('/contract-template')}}';

                        }
                    })

                })
            })

        });
        $(".datepicker").datepicker();
    </script>

@endsection

