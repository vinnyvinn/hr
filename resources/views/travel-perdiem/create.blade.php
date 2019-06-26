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
                Travel perdiem
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">New Travel perdiem</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="{{route('travel-perdiem.store')}}" accept-charset="UTF-8" encrypt="multipart/form-data">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">

                                        <div class="form-group">
                                            <label for="training_type">Select Department</label><br />
                                            <select class="form-control department_id"  id="department_id" name="department_id" required>
                                                <option></option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->department}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('department_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('department_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                      <div class="form-group">
                                          <label for="user_id">Staff</label>
                                          <select name="user_id[]" class="form-control select2 staff" multiple required></select>
                                      </div>

                                     <div class="form-group">
                                         <label for="employee">Search Staff</label>
                                         <option></option>
                                         <select name="employee[]" class="form-control select2 employee" multiple></select>
                                     </div>
                                       <div class="form-group">
                                           <label for="description">Description</label>
                                           <textarea name="description" id="description" cols="5" rows="3" class="form-control" required></textarea>
                                       </div>


                                   <div class="form-group">
                                    <input class="btn btn-success btn-flat" type="submit" value="Save">
                                    <a href="{{url('travel-perdiem')}}" type="button" class="btn btn-default btn-flat">Cancel</a>
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

    <script>
        $('.select2').select2();
        $('.datepicker').datepicker({
            autoclose: true,
            startDate: '+1d'
        });
        $('.department_id').on('change',getUsers);
        $('.department_id').on('change',moreUsers);

        function getUsers() {
            $.ajax({
                url:'{{url('get-users')}}'+'/'+$(this).val(),
                type:'GET',
                success: function (response) {

                    if (response.length){
                        $.each(response,function (key,user) {
                          $('.staff').append("<option value='"+user.id+"'>"+user.first_name +" "+ user.last_name+"</option>")
                        })
                    }
                }
            })
        }
        function moreUsers() {
            $.ajax({
                url:'{{url('get-more-users')}}'+'/'+$(this).val(),
                type:'GET',
                success:function (response) {

                        if(response.length){
                        $.each(response,function (key,value) {
                            console.log('12323');
                        $('.employee').append("<option value='"+value.id+"'>"+value.first_name+" "+ value.last_name+"</option>")
                        })
                    }
                }
            })
        }

    </script>

@endsection
