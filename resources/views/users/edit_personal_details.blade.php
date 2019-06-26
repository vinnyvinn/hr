@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Personal Details
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Edit Personal Details</h3>
                        </div>
                        <div class="box-body">
<form action="{{url('users/'.Auth::id())}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('patch')}}
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" required>
    </div>
    <div class="form-group">
        <label for="birthday">Birthday</label>
        <input type="text" name="birthday" class="form-control datepicker" value="{{$user->birthday}}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
    </div>
    <div class="form-group">
        <label for="telephone">Telephone</label>
        <input type="text" name="telephone" class="form-control" value="{{$user->telephone}}" required>
    </div>

    <div class="form-group">
        <label for="cellphone">Cellphone</label>
        <input type="text" name="cellphone" class="form-control" value="{{$user->cellphone}}" required>
    </div>
    <div class="form-group">
        <label for="family_contact">Family Contact</label>
        <input type="text" name="family_contact" class="form-control" value="{{$user->family_contact}}" required>
    </div>
    <div class="form-group">
        <label for="emergency_contact">Emergency Contact</label>
        <input type="text" name="emergency_contact" class="form-control" value="{{$user->emergency_contact}}" required>
    </div>
    <div class="form-group">
        <label for="first_guarantor">1st Guarantor Contact</label>
        <input type="text" name="first_guarantor" class="form-control" value="{{$user->first_guarantor}}" required>
    </div>
    <div class="form-group">
        <label for="second_guarantor">2nd Guarantor Contact</label>
        <input type="text" name="second_guarantor" class="form-control" value="{{$user->second_guarantor}}" required>
    </div>

    <div class="form-group">
        <label for="local_address">Local Address</label>
        <input type="text" name="local_address" class="form-control" value="{{$user->local_address}}" required>
    </div>
    <div class="form-group">
        <label for="permanent_address">Identification Number</label>
        <input type="text" name="permanent_address" class="form-control" value="{{$user->permanent_address}}" required>
    </div>
    <div class="form-group">
        <label for="id_no">Permanent Address</label>
        <input type="text" name="id_no" class="form-control" value="{{$user->id_no}}" required>
    </div>

    <div class="form-group">
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

        <div class="pull-right">
            {!! Form::submit('Update', ['class' => 'btn btn-success btn-flat']) !!}
            <a href="{{url('/') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
        </div>

</form>
                        </div></div></div></div></section></div>
    @endsection