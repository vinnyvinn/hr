@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">

@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Hotels
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Create Hotel </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{route('hotels.store')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Hotel Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                               <label>Room Types</label>
                                <table id="dynamicTable" class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <th>Rate/Day</th>
                                        <th>Currency</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="addmore[0][room_name]" class="form-control" required></td>
                                        <td><input type="number" name="addmore[0][rate]" class="form-control" required></td>
                                        <td><input type="text" name="addmore[0][currency]" class="form-control" required></td>
                                       <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>

                                    </tr>
                                </table>

                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-success">

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
$('#add').on('click',addMore)
var i=0;
        function  addMore() {
            ++i;
            $('#dynamicTable').append("<tr><td><input type='text' name='addmore["+i+"][room_name]' class='form-control' required></td><td><input type='number' name='addmore["+i+"][rate]' class='form-control' required></td><td><input type='text' name='addmore["+i+"][currency]' class='form-control' required></td><td><button type='button' class='btn btn-danger remove-tr'>Remove</button></td></tr>");
        }
$(document).on('click', '.remove-tr', function(){
    $(this).parents('tr').remove();
});

    </script>

@endsection

