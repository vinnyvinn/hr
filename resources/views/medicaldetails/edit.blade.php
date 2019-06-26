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
                            <h3 class="box-title">Edit Medical Detail</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('medical-details.update',$user->id)}}" accept-charset="UTF-8">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label for="user_id">Employee</label>
                                    <input readonly class="form-control" id="employee" value="{{$user->first_name.' '.$user->last_name}}" name="employee" type="text">
                                    <input value="{{$user->id}}" id="user_id" name="user_id" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <select required name="blood_group" id="blood_group" class="form-control">
                                        <option hidden value="">Select blood group</option>
                                        <option value="A+" {{$user->blood_group =='A+' ? 'selected="selected"' : ''}}>A RhD positive (A+)</option>
                                        <option value="A-" {{$user->blood_group =='A-' ? 'selected="selected"' : ''}}>A RhD negative (A-)</option>
                                        <option value="B+" {{$user->blood_group =='B+' ? 'selected="selected"' : ''}}>B RhD positive (B+)</option>
                                        <option value="B-" {{$user->blood_group =='B-' ? 'selected="selected"' : ''}}>B RhD negative (B-)</option>
                                        <option value="O+" {{$user->blood_group =='O+' ? 'selected="selected"' : ''}}>O RhD positive (O+)</option>
                                        <option value="O-" {{$user->blood_group =='O-' ? 'selected="selected"' : ''}}>O RhD negative (O-)</option>
                                        <option value="AB+" {{$user->blood_group =='AB+' ? 'selected="selected"' : ''}}>AB RhD positive (AB+)</option>
                                        <option value="AB-" {{$user->blood_group =='AB-' ? 'selected="selected"' : ''}}>AB RhD negative (AB-)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="allergies">Allergies</label>
                                    <input class="form-control" value="{{$user->allergies}}" name="allergies" type="text" id="allergies">
                                </div>
                                <div class="form-group">
                                    <label for="doctor">Doctor</label>
                                    <input class="form-control" value="{{$user->doctor}}" name="doctor" type="text" id="doctor">
                                </div>
                                <div class="form-group">
                                    <label for="clinic_tel">Clinic Tel</label>
                                    <input class="form-control" value="{{$user->clinic_tel}}" name="clinic_tel" type="text" id="clinic_tel">
                                </div>
                                <div class="form-group">
                                    <label for="disabled">Disabled</label>
                                    <select class="form-control" required id="disabled" name="disabled">
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prescription">Medical Prescription</label>
                                    <input class="form-control" value="{{$user->prescription}}" name="prescription" type="text" id="prescription">
                                </div>
                                <div class="pull-right">
                                    <input class="btn btn-success btn-flat" type="submit" value="Update">
                                    <a href="{{route('medical-details.index')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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
