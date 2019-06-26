@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Loan/ Advance
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    {{--<a href="{{ url('/contracts/create') }}" type="button" class="btn btn-success btn-flat margin">New Contract</a>--}}

                    <div class="box box-success">
                        <div class="box-header">
                            <a href="{{url('loans/create')}}" class="btn btn-info btn-sm pull-right">Apply Now</a>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                @foreach($loans as $loan)
                                    <tr>
                                        <td>{{ $loan->id }}</td>

                                        <td>
                                            {{$loan->user->first_name .' '.$loan->user->last_name}}
                                        </td>
                                        <td>{{$loan->user->department->department}}</td>
                                        <td>{{ $loan->user->designation_item->designation_item }}</td>
                                        <td>{{$loan->type}}</td>
                                        <td>{{$loan->amount}}</td>
                                        <td>
                                            @if($loan->status ==1)
                                                <span class="label label-success">Approved</span>
                                                @elseif($loan->status ==2)
                                                    <span class="label label-warning">Rejected</span>
                                                @else
                                                    <span class="label label-info">Pending Approval</span>
                                                @endif
                                        </td>
                                        <td>
                                            @if(Auth::user()->role->layout==1)
                                            @if(!$loan->status ==1 || !$loan->status ==2)
                                            <a href="#" class="label label-info approve_now" data-toggle="modal"
                                               data-target=".bs-example-modal-approve" app_id="{{$loan->id}}"><i
                                                        class="fa fa-check">Approve</i></a>
                                            <a href="#" class="label label-danger reject_now" data-toggle="modal"
                                               data-target=".bs-example-modal-reject" rej_id="{{$loan->id}}"><i
                                                        class="fa fa-lock">Reject</i></a>
                                                @endif
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{--///Approve modal--}}
            <div class="modal fade bs-example-modal-approve" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Enter Approved Amount</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <form class="approve_form">
                                    <div class="row">
                                        {{ csrf_field() }}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="user_id">Staff</label>
                                                <input type="text" class="form-control" name="user_id" disabled
                                                       id="user_id">
                                            </div>
                                            <div class="form-group">
                                                <input type="number" id="amount" step="0.01" name="amount"
                                                       class="form-control"
                                                       placeholder="Amount">
                                                <br>
                                                <span class="help_amount"></span>
                                            </div>

                                            <div class="form-group">
                                                <input class="btn pull-right  btn btn-success" type="submit"
                                                       value="Approve">
                                                <button type="button" class="btn btn-danger waves-effect pull-right"
                                                        data-dismiss="modal" style="margin-right: 5px">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{--//end Approve--}}
            <div class="modal fade bs-example-modal-reject" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Message Body</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <form class="reject_form">
                                    <input type="hidden" name="id" id="r_id">
                                    <div class="row">
                                        {{ csrf_field() }}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea name="message" id="mymce"

                                                          rows="5"
                                                          placeholder="Type reason here"
                                                          class="form-control"></textarea>
                                                <br>
                                                <span class="help_message"></span>
                                            </div>
                                            <div class="form-group">
                                                <input class="btn pull-right  btn btn-warning" type="submit"
                                                       value="Reject">
                                                <button type="button" class="btn btn-danger waves-effect pull-right"
                                                        data-dismiss="modal" style="margin-right: 5px">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('foot')
<script>

    $(function () {
        var approve_id = '';
        var reject_id = '';
        $('.approve_now').on('click', function () {
            approve_id = $(this).attr('app_id');
            var url = '{{url('loan-amount')}}' + '/' + approve_id;
            $.get(url, function (data) {
                console.log(data);
                $("input[name='amount']").val(data.amount);
                $("input[name='user_id']").val(data.username);
            });

        })
        $('.approve_form').on('submit', function (e) {
            e.preventDefault();

            if ($('#amount').val() == '') {
                $('.help_amount').html('Amount is required').css('color', 'red');
                $("input[name='amount']").css('background-color', 'red');
            } else {
                $('.help_amount').html('');
                $("input[name='amount']").css('background-color', 'white');
            }
            $.ajax({
                url: '{{url('update-amount')}}' + '/' + approve_id,
                data: $(this).serialize(),
                type: 'POST',
                success: function (response) {
                    window.location.reload();

                }
            });
        });
        $('.reject_now').on('click', function () {
            reject_id = $(this).attr('rej_id');
            $("input[name='id']").val(reject_id);
        });
        $('.reject_form').on('submit', function (e) {
            e.preventDefault();

            var message = $('#mymce').val();

            if (message == undefined) {
                $('.help_message').html('Message is required.').css('color', 'red');
            } else {
                $('.help_message').html('');
            }
            $.ajax({
                url: '{{url('reject-loan')}}' + '/' + reject_id,
                data: $(this).serialize(),
                type: 'POST',
                success: function (response) {
                    window.location.reload();
                }
            });
        })
    })


    jQuery(function($) {
        //initiate dataTables plugin
        var myTable =
            $('.dataTable')
            //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable( {
                    bAutoWidth: false,
                    "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null

                    ],
                    "aaSorting": [],


                    //"bProcessing": true,
                    //"bServerSide": true,
                    //"sAjaxSource": "http://127.0.0.1/table.php"   ,

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50


                    select: {
                        style: 'multi'
                    }
                });
    });

</script>
@endsection
