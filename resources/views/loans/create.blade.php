@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')

    <script src="{{asset('dist/js/jquery.js')}}"></script>
    <link href="{{ asset('/plugins/iCheck/square/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Loans/ Advance
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Loans/ Advance </h3>
                        </div>
                        <div class="box-body">
                                <form class="loan">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="gross_amount">Select Staff</label>
                                    <select name="user_id" id="user_id" class="form-control staff">
                                        @foreach($users as $staff)
                                            <option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <span class="help_user"></span>
                                </div>

                                    <div class="form-group">
                                        <input type="radio" name="type" value="Loan" class="type">
                                        <label class="margin">Loan</label>
                                        <input type="radio" name="type" value="Advance" class="type">
                                        <label class="margin">Advance</label>
                                        <br>
                                        <span class="help_type"></span>
                                    </div>
                                    <div class="form-group advance_plate">
                                        <label for="advance_amount">Advance amount</label>
                                        <input type="number" step="0.01" name="advance_amount" class="form-control" id="advance_amount">
                                        <br>
                                        <span class="help_advance_amount"></span>
                                    </div>
                                    <div class="form-group advance_plate">
                                        <label for="rq_date">Requested by date</label>
                                        <input type="text"  name="rq_date" class="form-control datepicker" id="rq_date">
                                        <br>
                                        <span class="help_rq_date"></span>
                                    </div>
                                    <div class="form-group loan_plate">
                                        <label for="loan_amount">Loan amount</label>
                                        <input type="number" step="0.01" name="loan_amount" class="form-control" id="loan_amount">
                                        <br>
                                        <span class="help_loan_amount"></span>
                                    </div>
                                    <div class="form-group loan_plate">
                                        <label for="repay_date">Repayment by date</label>
                                        <input type="text"  name="repay_date" class="form-control datepicker" id="repay_date">
                                        <br>
                                        <span class="help_repay_date"></span>
                                    </div>
                                    <div class="form-group loan_plate">
                                        <label for="monthly_repayment">Monthly amount to be repaid</label>
                                        <input type="number"  name="monthly_repayment" step="0.01" class="form-control" id="monthly_repayment">
                                        <br>
                                        <span class="help_monthly_repayment"></span>
                                    </div>
                                    <div class="form-group loan_plate">
                                        <label for="interest_rate">Agreed interest rate</label>
                                        <input type="number" step="0.01" name="interest_rate" class="form-control" id="interest_rate">
                                        <br>
                                        <span class="help_interest_rate"></span>
                                    </div>
                                    <div class="form-group loan_plate">
                                        <label for="installment_months">Installment months</label>
                                        <input type="number" step="0.01" name="installment_months" class="form-control" id="installment_months">
                                        <br>
                                        <span class="help_installment_months"></span>
                                    </div>

                                    <div class="form-group loan_plate">
                                        <label for="purpose">Purpose of loan</label>
                                        <select name="purpose" id="purpose" class="form-control">
                                            <option value="Emergency">Emergency</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Sick">Sick</option>
                                        </select>
                                        <br>
                                        <span class="help_purpose"></span>
                                    </div>

                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-success" id="loan">
                                    <a href="{{url('/loans')}}" class="btn btn-default">Cancel</a>
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


        $(document).ready(function () {
            var val ='';

     $('.type').on('change',function () {
          val = $(this).val();
         console.log(val)
         if (val=='Loan'){
           $('.loan_plate').show();
             $('.advance_plate').hide();
         }
         else{
             $('.loan_plate').hide();
             $('.advance_plate').show();
         }
     });

         $('.loan').on('submit',function (e) {
            e.preventDefault();

             var type=$('.type').is(':checked');
             var advance_amount = $('#advance_amount').val();
             var rq_date = $('#rq_date').val();
             var loan_amount = $('#loan_amount').val();
             var repay_date = $('#repay_date').val();
             var interest_rate = $('#interest_rate').val();
             var installment_months = $('#installment_months').val();
             var monthly_repayment = $('#monthly_repayment').val();
             var purpose = $('#purpose').val();
             var user = $('#user_id').val();

            if (val=='Loan') {
                if (loan_amount =='') {

                    $('.help_loan_amount').html('Loan field is required').css('color', 'red');
                } else {
                    $('.help_loan_amount').html('');
                }
                if (repay_date =='') {
                    $('.help_repay_date').html('Repayment by date field is required').css('color', 'red');
                } else {
                    $('.help_repay_date').html('');
                }
                if (monthly_repayment =='') {
                    $('.help_monthly_repayment').html('Monthly amount to be repaid field is required').css('color', 'red');
                } else {
                    $('.help_monthly_repayment').html('');
                }
                if (interest_rate =='') {
                    $('.help_interest_rate').html('Interest rate field is required').css('color', 'red');
                } else {
                    $('.help_interest_rate').html('');
                }
                if (installment_months =='') {
                    $('.help_installment_months').html('Installment months field is required').css('color', 'red');
                } else {
                    $('.help_installment_months').html('');
                }
                if (purpose =='') {
                    $('.help_purpose').html('Purpose of loan field is required').css('color', 'red');
                } else {
                    $('.help_purpose').html('');
                }
            }
            else if(val=='Advance'){
                if (advance_amount =='') {
                    $('.help_advance_amount').html('Advance field is required').css('color', 'red');
                } else {
                    $('.help_advance_amount').html('');
                }
                if (rq_date =='') {
                    $('.help_rq_date').html('Requested by date field is required').css('color', 'red');
                } else {
                    $('.help_rq_date').html('');
                }
            }
              if (!type){

                  $('.help_type').html('Loan Type field is required').css('color','red');
              }
              else {
                  $('.help_type').html('');
              }
             if (user==null){

                 $('.help_user').html('Staff is required').css('color','red');
             }
             else {
                 $('.help_user').html('');
             }

             console.log($(this).serialize())

                 $.ajax({
                     url:'{{route('loans.store')}}',
                     data:$(this).serialize(),
                     type:'POST',
                     success: function (data) {
                          window.location.href = '{{url('loans')}}';
                     }
                 })
         })

            // $('input').iCheck({
            //     checkboxClass: 'icheckbox_square-green',
            //     radioClass: 'iradio_square-green'
            // });


        });


        $("#expiry_date,#repay_date,#rq_date").datepicker();
        $('.staff,#purpose').select2();

    </script>

@endsection

