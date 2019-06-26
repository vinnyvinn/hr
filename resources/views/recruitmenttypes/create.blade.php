@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link href="{{ asset('/plugins/iCheck/square/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Recruitment Type
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Recruitment Type</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('recruitment-type.store')}}" accept-charset="UTF-8" enctype="multipart/form-data">
{{csrf_field()}}                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control"  name="name" type="text">
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<input checked="checked" name="status" type="radio" value="1">--}}
                                    {{--<label for="status" class="margin">Open</label>--}}
                                    {{--<input name="status" type="radio" value="0" id="status">--}}
                                    {{--<label for="status" class="margin">Close</label>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" name="description" cols="50" id="description"></textarea>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label for="type">Job Type</label>--}}
                                    {{--<input class="form-control" name="type" type="text" id="type">--}}
                                {{--</div>--}}
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{route('recruitment-type.index')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
                                </div>                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('foot')
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/plugins/iCheck/icheck.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $( "#employee" ).autocomplete({
                source: "{{ asset('autocomplete/users')}}",
                minLength: 1,
                select: function(event, ui) {
                    $('#employee').val(ui.item.value);
                    $('#user_id').val(ui.item.id);
                }
            });
        });

        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        });
    </script>
@endsection
