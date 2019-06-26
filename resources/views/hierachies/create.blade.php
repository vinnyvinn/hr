@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Hierachy
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Hierachy </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('hierachy.store')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="manager_id">Select Manager</label>
                                    <select name="manager_id" id="manager_id" class="form-control staff" required>
                                        @foreach($users as $staff)
                                            <option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="supervisor_id">Select Supervisor / TeamLead</label>
                                    <select name="supervisor_id" id="supervisor_id" class="form-control staff" required>
                                        @foreach($users as $staff)
                                            <option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="staff_id">Select Staff Member</label>
                                    <select name="staff_id" id="staff_id" class="form-control staff" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name .' '.$user->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="user_id">Select Sub-ordinates</label>
                                    <select name="user_id[]" id="user_id" class="form-control staff" multiple>
                                        @foreach($users as $subo)
                                            <option value="{{$subo->id}}">{{$subo->first_name .' '.$subo->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-success">
                                    <a href="{{url('/hierachy')}}" class="btn btn-default">Cancel</a>
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


    <script>


        $('.staff').select2();

    </script>

@endsection

