@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'user')

@section('head')
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Bank accounts
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Format</h3>
                        </div>
                        <div class="box-body">
                            {!! Form::open(['url' => 'reports/bankAccounts', 'target' => '_blank']) !!}


                            <div class="form-group{{ $errors->has('format') ? ' has-error' : '' }}">
                                {!! Form::label('format', 'Document Format') !!}
                                <select name="format" id="format" class="form-control">
                                    <option value="xls" selected>Excel XLS</option>
                                    <option value="xlsx">Excel 2007 and above XLSX</option>
                                    <option value="pdf">PDF</option>
                                </select>
                                @if ($errors->has('format'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('format') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="pull-right">
                                {!! Form::submit('Generate', ['class' => 'btn btn-success btn-flat']) !!}
                                <a href="{{ isset($user->id) ? asset('/users/'.$user->id) : asset('/bankAccounts') }}"
                                   type="button" class="btn btn-default btn-flat">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('foot')
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.datepicker').datepicker({
                autoclose: true,
                endDate: '-1d'
            });
            $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            $("[data-mask]").inputmask();
        });
    </script>
@endsection