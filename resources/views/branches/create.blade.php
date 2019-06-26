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
                Zone
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Zone</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('branches.store')}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                {{--<input type="hidden" name="user_id" value="1">--}}
                                <div class="form-group">
                                    <label for="name">Choose Zone</label>
                                    <select name="name" class="form-control zones" required>
                                        <option></option>
                                      @foreach($zones as $key=>$value)
                                        <option value="{{$key}}">{{$key}}</option>
                                            @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input required  type="text" class="form-control" id="contact" name="contact">
                                </div>
                                <div class="form-group">
                                    <label for="location">Select City</label><br />
                                    <select class="form-control"  id="location" name="location" required>

                                    </select>
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{url('/branches')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
            $('.zones').on('change',function () {
              $('#location').empty();
                $.ajax({
                    url:'{{url('fetch-cities')}}',
                    type:'GET',
                    data:{zone:$(this).val()},
                    success: function (response) {
                        //console.log(response);
                        $.each(response,function (key,value) {
                            console.log(key);
                            $('#location').append("<option value='"+value+"'>"+value+"</option>")
                        })
                    }
                })
            })

            $('.datepicker').datepicker({
                autoclose: true,
                startDate: '+1d'
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