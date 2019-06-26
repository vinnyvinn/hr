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
                            <h3 class="box-title">Edit Zone</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('branches.update',$id)}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label for="name">Zone</label>
                                    <input required autofocus type="text" value="{{$branch->name}}" class="form-control" id="zone" name="name" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input required  type="text" min="1" value="{{$branch->contact}}"  class="form-control" id="contact" name="contact">
                                </div>
                                <div class="form-group">
                                    <label for="location">Select City</label><br />
                                    <select class="form-control"  id="location" name="location" required>
                                        <option value="{{$branch->location}}" selected>{{$branch->location}}</option>

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
            console.log($('#zone').val());
            $.ajax({
                url:'{{url('fetch-cities')}}',
                data:{zone:$('#zone').val()},
                success: function (response) {
                    console.log(response)
                    $.each(response,function (key,value) {
                        $('#location').append("<option value='"+value+"'>"+value+"</option>")
                    })

                }
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