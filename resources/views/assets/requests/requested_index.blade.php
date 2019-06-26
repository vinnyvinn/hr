@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Requested Assets
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('alert.success')
                    {{--<a href="{{ url('/contracts/create') }}" type="button" class="btn btn-success btn-flat margin">New Contract</a>--}}
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Requested Assets List</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover dataTable">
                                <tr>
                                    <th>EmpID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Asset</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($assetss as $asset)
                                    <tr>
                                        <td>{{ $asset->user->id }}</td>
                                        <td>
                                          {{$asset->user->first_name.' '.$asset->user->last_name}}
                                        </td>
                                        <td>{{$asset->user->department ? $asset->user->department->department :''}}</td>
                                        <td>{{ $asset->user->designation_item ? $asset->user->designation_item->designation_item :''}}</td>
                                        <td>{{$asset->asset->asset_type->name}}</td>
                                        <td>
                                            @if(!$asset->status ==1 || !$asset->status ==2)
                                                <a href="#" class="label label-info approve_now" data-toggle="modal"
                                                   data-target=".bs-example-modal-approve" app_id="{{$asset->id}}"><i
                                                            class="fa fa-check">Approve</i></a>
                                                <a href="#" class="label label-danger reject_now" data-toggle="modal"
                                                   data-target=".bs-example-modal-reject" rej_id="{{$asset->id}}"><i
                                                            class="fa fa-lock">Reject</i></a>
                                            @endif
                                            @if($asset->status ==1)
                                                <span class="label label-success">Approved</span>
                                            @endif
                                            @if($asset->status ==2)
                                                <span class="label label-warning">Rejected</span>
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
                            <h4 class="modal-title" id="myLargeModalLabel">Approve Requested Asset</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <form class="approve_form">
                                    <div class="row">
                                        {{ csrf_field() }}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="make">make</label>
                                                <input type="text" class="form-control" name="make" disabled
                                                       id="make">
                                            </div>
                                            <div class="form-group">
                                                <label for="model">Model</label>
                                                <input type="text" class="form-control" name="model" disabled
                                                       id="model">
                                            </div>

                                            <div class="form-group">
                                                <label for="type">type</label>
                                                <input type="text" class="form-control" name="type" disabled
                                                       id="type">
                                            </div>
                                            <div class="form-group">
                                                <label for="serial_no">Serial Number</label>
                                                <input type="text" class="form-control" name="serial_no" disabled
                                                       id="serial_no">
                                            </div>
                                            <div class="form-group">
                                                <label for="part_no">Part Number</label>
                                                <input type="text" class="form-control" name="part_no" disabled
                                                       id="part_no">
                                            </div>
                                            <div class="form-group">
                                                <label for="color">Color</label>
                                                <input type="text" class="form-control" name="color" disabled
                                                       id="color">
                                            </div>
                                            <div class="form-group">
                                                <label for="color">Requested date</label>
                                                <input type="text" class="form-control" name="req_date" disabled
                                                       id="req_date">
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
                                                <label for="message">Reason for rejection</label>
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

            var url = '{{url('asset-details')}}' + '/' + approve_id;
            $.get(url, function (response) {
                console.log(response);
                $("input[name='make']").val(response.make);
                $("input[name='model']").val(response.model);
                $("input[name='type']").val(response.type);
                $("input[name='serial_no']").val(response.serial_no);
                $("input[name='part_no']").val(response.part_no);
                $("input[name='color']").val(response.color);
                $("input[name='req_date']").val(response.req_date);

            });

        })
        $('.approve_form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{url('approve-request')}}' + '/' + approve_id,
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

            if (message == '') {
                $('.help_message').html('Message is required.').css('color', 'red');
            } else {
                $('.help_message').html('');
            }
            $.ajax({
                url: '{{url('reject-request')}}' + '/' + reject_id,
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
