<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="form-group{{ $errors->has('leave_type') ? ' has-error' : '' }}">
    <label for="leave_type">Leave Type</label>
    <input type="text" class="form-control" name="leave_type" value="{{$leave_type->leave_type}}">
    @if ($errors->has('leave_type'))
        <span class="help-block">
			<strong>{{ $errors->first('leave_type') }}</strong>
		</span>
    @endif
</div>
<div class="form-group">
    <h3 class="g-header">Categorized</h3>
    <div class="radio radio-inputs">

        <label class="d-radio"><input type="radio" name="selected_by" value="by_staff" {{$leave_type->selected_by=='by_staff' ? 'checked' :''}} id="by_staff"><strong>By Staff</strong></label>
    </div>
    <div class="radio radio-inputs">
        <label><input type="radio" name="selected_by" value="by_designation" {{$leave_type->selected_by=='by_designation' ? 'checked' :''}} id="by_designation"><strong>By Designation</strong></label>
    </div>
    <div class="radio radio-inputs">
        <label class="d-radio"><input type="radio" name="selected_by" value="by_gender" {{$leave_type->selected_by=='by_gender' ? 'checked' :''}} id="by_gender"><strong>By Gender</strong></label>
    </div>
</div>

<div class="form-group staff-control">
    <label for="staffs">Selected Staff</label>
    <select name="staff_type_id[]" id="staffs" class="form-control" multiple="true">
        @foreach($staff as $stf)
            <option value="{{$stf->id}}" @foreach($leave_type->staffs as $user) @if($user->id==$stf->id)selected="selected"@endif @endforeach>{{$stf->first_name .' '.$stf->last_name}}</option>
             @endforeach
    </select>
</div>

<div class="form-group dept-control">
    <label for="designation">Designation</label>
    <select name="designation[]" id="designation" class="form-control" multiple="true">
        @foreach($departments as $dept)
            @foreach($leave_type->departments as $desig)
            <option value="{{$dept->id}}" {{$desig->id == $dept->id ? 'selected="selected"' : ''}}>{{$dept->department}}</option>
        @endforeach
            @endforeach

    </select>
</div>

<div class="form-group gender-control">
    <h3 class="g-header">Gender</h3>

    <div class="radio radio-inputs">
        <label class="d-radio"><input type="radio" name="gender" value="m" {{$leave_type->gender =='m' ? 'checked' : ''}} id="male"><strong>Male</strong></label>
    </div>
    <div class="radio radio-inputs">
        <label><input type="radio" name="gender" value="f" {{$leave_type->gender =='f' ? 'checked' : ''}} id="female"><strong>Female</strong></label>
    </div>


</div>


<div class="radio radio-layout">
    <label class="d-radio-layout"><input type="checkbox" id="count_days" name="count_days" value="1" {{$leave_type->count_days==1 ? 'checked' :''}}><span class="count-template" style="padding-left: 5px">Count half days</span></label>
</div>

<div class="form-group time-control">

    <div class="radio radio-inputs">
        <input type="checkbox" name="count_start_half_day" value="1" {{$leave_type->count_start_half_day ==1 ? 'checked' : ''}} id="start"><strong class="count-start">Leave start half day not counted</strong></label>
    </div>
    <div class="radio radio-inputs">
        <label><input type="checkbox" name="count_end_half_day" value="1" {{$leave_type->count_end_half_day ==1 ? 'checked' : ''}} id="end"><strong class="count-start">Leave end half day not counted</strong></label>
    </div>

</div>

<div class="radio radio-back">
    <label class="d-radio back-layout"><input type="checkbox" name="backstopper_id" value="1" {{$leave_type->backstopper_id==1 ? 'checked' : ''}} id="back-stop"><span class="count-template" style="padding-left: 5px">Leave requires back-stopping</span></label>
</div>


<div class="radio radio-layout-2">
    <label class="d-radio-layout"><input type="checkbox" name="carried_forward" value="1" {{$leave_type->carried_forward==1 ? 'checked' : ''}} id="carried_forward"><span class="count-template"  style="padding-left: 5px">Leave can be carried forward</span></label>
</div>

<div class="radio radio-layout-2">
    <label class="d-radio-layout"><input type="checkbox" name="encashed" value="1" {{$leave_type->encashed==1 ? 'checked' : ''}} id="encashed"><span class="count-template"  style="padding-left: 5px">Leave can be encashed</span></label>
</div>




<div class="pull-right">
    <button class="btn btn-info btn-flat" type="submit" value="Save">Update</button>
    <a href="{{ asset('/leave-types') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>



<script type="text/javascript">
    $("#staffs,#designation,#staff_id").select2();

    $('#by_staff').click(function () {
        $('.staff-control').show();
        $('.dept-control').hide();
        $('.gender-control').hide();
    })
    $('#by_designation').click(function () {
        $('.staff-control').hide();
        $('.dept-control').show();
        $('.gender-control').hide();
    })
    $('#by_gender').click(function () {
        $('.staff-control').hide();
        $('.dept-control').hide();
        $('.gender-control').show();
    })
    $('#count_days').click(function () {
        if ($(this).is(':checked')){
            $('.time-control').show();
        }
        else {
            $('.time-control').hide();
        }
    })
    $('#back-stop').click(function () {
        $('.back-stop').show();

    })

    $("#count_days").is(':checked') ? $('.time-control').show() : $('.time-control').hide();
    $("#by_staff").is(':checked') ? $('.staff-control').show() : $('.staff-control').hide();
    $("#by_designation").is(':checked') ? $('.dept-control').show() : $('.dept-control').hide();
    $("#by_gender").is(':checked') ? $('.gender-control').show() : $('.gender-control').hide();

</script>

