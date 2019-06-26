@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Travel Plan
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Create Travel Plan </h3>
                        </div>
                        <span class="modes" modes="{{$modes}}"></span>
                        <div class="box-body">
                            <form class="hotel_form">
                                <span class="myform" action="{{route('travels.store')}}"></span>
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="user_id">Staff</label>
                                    <select name="user_id" id="user_id" class="form-control select2">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" name="start_date" class="form-control datepicker" required>
                                </div>

                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="text" name="end_date" class="form-control datepicker" required>
                                </div>
                                <div class="form-group">
                                    <label for="project_id">Project</label>
                                    <select name="project_id" id="project_id" class="form-control select2">
                                        @foreach($projects as $project)
                                            <option value="{{$project->ProjectCode}}">{{$project->ProjectCode}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <label>Itinerary</label>
                                <table id="dynamicTable" class="table table-bordered">
                                    <tr>
                                        <th>Place</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Fare</th>
                                        <th>Mode</th>
                                         <th>Action</th>
                                      </tr>
                                     <tr>
                                        <td><input type="text" name="addmore[0][place]" class="form-control" required></td>
                                        <td><input type="text" name="addmore[0][from]" class="form-control datepicker" required></td>
                                        <td><input type="text" name="addmore[0][to]" class="form-control datepicker" required></td>
                                        <td><input type="number" name="addmore[0][fare]" class="form-control" required></td>
                                         <td><select name="addmore[0][mode]" class="form-control mode" style="width: 100%">
                                                 @foreach($modes as $mode)
                                                     <option value="{{$mode->name}}">{{$mode->name}}</option>
                                                     @endforeach
                                             </select></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>

                                <div class="form-group">
                                    <label for="accomodate">
                                    <input type="checkbox" name="accomodate" class="accomodate">
                                        Accomodation ?
                                    </label>
                                </div>
                                   <span class="rooms_template">
                                        <div class="form-group">
                                    <label for="hotel">Hotel</label>
                                    <select name="hotel" class="form-control hotel select2" style="width: 100%">
                                        <option></option>
                                        @foreach($hotels as $hotel)
                                            <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class="form-group">
                                    <label for="room">Room Type</label>
                                    <select name="room" class="form-control select2 room" style="width: 100%">
                                        <option></option>
                                    </select>
                                </div>
                                   </span>

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
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script>
        $('.rooms_template').hide();
        var modes = $('.modes').attr('modes');
        var accomodate=false;
        $('.accomodate').on('click',function () {
            accomodate = $(this).is(':checked');
            if (accomodate){
                $('.rooms_template').show();
            }
            else {
                $('.rooms_template').hide();
            }
        })
         $('.select2').select2();
        $('#add').on('click',addMore);
        $('.hotel').on('change',getRooms);
        $('.hotel_form').on('submit',submitForm);
          function submitForm(e) {
            e.preventDefault();
            if (accomodate){
                if ($('.hotel').val() =='' || $('.room').val() ==''){
                    return toastr.warning('fail','Please Select Room first to proceed.');
                }
            }
            $.ajax({
                url:$('.myform').attr('action'),
                type:'POST',
                data:$(this).serialize(),
                success:function (response) {
                  window.location.href='{{url('travels')}}';
                }
            })
        }

        function getRooms() {
            $.ajax({
                url:'{{url('get-rooms')}}'+'/'+$(this).val(),
                type:'GET',
                success: function (response) {
                   $('.room').empty();
                    $.each(response,function (key,value) {
                        $('.room').append("<option value='"+value.name+"'>"+value.name+"</option>");
                    })
                }
            })
        }
        var i=0;
           function  addMore() {
            ++i;
               var html ="";
                html += "<tr><td><input type='text' name='addmore[" + i + "][place]' class='form-control' required></td><td><input type='text' name='addmore[" + i + "][from]' class='form-control datepicker' required></td><td><input type='text' name='addmore[" + i + "][to]' class='form-control datepicker' required></td><td><input type='number' name='addmore[" + i + "][fare]' class='form-control'></td>"
                html +="<td><select name='addmore["+ i +"][mode]' class='form-control'>"
                    $.each(JSON.parse(modes),function (key,value) {
                        html += "<option value='"+value.name+"'>"+value.name+"</option>"
                    })
                    html +="</select></td><td>"
                    html +="<button type='button' class='btn btn-danger remove-tr'>Remove</button></td></tr>"
             $("#dynamicTable").append(html);

        }
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
        $(document).on('focus', '.datepicker', function() {
            $(this).datepicker();
        });
    </script>

@endsection

