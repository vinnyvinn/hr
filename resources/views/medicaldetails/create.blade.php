@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Medical Details
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Medical Detail</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('medical-details.store')}}" accept-charset="UTF-8">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label for="user_id">Employee</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($employees as $empl)
                                            <option value="{{$empl->id}}">{{$empl->first_name .' '.$empl->last_name}}</option>
                                            @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select required name="blood_group" id="blood_group" class="form-control">
                                        <option hidden value="">Select blood group</option>
                                    <option value="A+">A RhD positive (A+)</option>
                                    <option value="A-">A RhD negative (A-)</option>
                                    <option value="B+">B RhD positive (B+)</option>
                                    <option value="B-">B RhD negative (B-)</option>
                                    <option value="O+">O RhD positive (O+)</option>
                                    <option value="O-">O RhD negative (O-)</option>
                                    <option value="AB+">AB RhD positive (AB+)</option>
                                    <option value="AB-">AB RhD negative (AB-)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="allergies">Allergies</label>
                                    <input class="form-control" name="allergies" type="text" id="allergies">
                                </div>
                                <div class="form-group">
                                    <label for="doctor">Doctor</label>
                                    <input class="form-control" name="doctor" type="text" id="doctor">
                                </div>
                                <div class="form-group">
                                    <label for="clinic_tel">Clinic Tel</label>
                                    <input class="form-control" name="clinic_tel" type="text" id="clinic_tel">
                                </div>
                                <div class="form-group">
                                    <label for="disabled">Disabled</label>
                                    <select class="form-control" required id="disabled" name="disabled"><option value="NO">NO</option><option value="YES">YES</option></select>
                                </div>
                                <div class="form-group">
                                    <label for="prescription">Medical Prescription</label>
                                    <input class="form-control" name="prescription" type="text" id="prescription">
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{url('medical-details')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
    </script>
@endsection
