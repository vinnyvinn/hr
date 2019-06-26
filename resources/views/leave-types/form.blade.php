
<script src="{{asset('dist/js/jquery.js')}}"></script>
	<link href="{{asset('dist/css/selector2.min.css')}}" rel="stylesheet" />
<script src="{{asset('dist/js/selector2.min.js')}}"></script>


<div class="form-group{{ $errors->has('leave_type') ? ' has-error' : '' }}">
	<label for="leave_type">Leave Type</label>
	<input type="text" class="form-control" name="leave_type">
	@if ($errors->has('leave_type'))
		<span class="help-block">
			<strong>{{ $errors->first('leave_type') }}</strong>
		</span>
	@endif
</div>
<div class="form-group">
	<h3 class="g-header">Categorized</h3>
	<div class="radio radio-inputs">
		<label class="d-radio"><input type="radio" name="selected_by" value="by_all" id="by_all"><strong>By All</strong></label>
	</div>
	<div class="radio radio-inputs">
		<label class="d-radio"><input type="radio" name="selected_by" value="by_staff" id="by_staff"><strong>By Staff</strong></label>
	</div>
	<div class="radio radio-inputs">
		<label><input type="radio" name="selected_by" value="by_designation" id="by_designation"><strong>By Designation</strong></label>
	</div>
	<div class="radio radio-inputs">
		<label class="d-radio"><input type="radio" name="selected_by" value="by_gender" id="by_gender"><strong>By Gender</strong></label>
	</div>
</div>

<div class="form-group staff-control">
	<label for="staffs">Staff</label>
	<select name="staff_type_id[]" id="staffs" class="form-control" multiple="true">
		@foreach($staff as $staff)
			<option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
		@endforeach

	</select>
</div>

<div class="form-group dept-control">
	<label for="designation">Designation</label>
	<select name="designation" id="designation" class="form-control" multiple="true">
		@foreach($departments as $dept)
			<option value="{{$dept->id}}">{{$dept->department}}</option>
		@endforeach

	</select>
</div>

<div class="form-group gender-control">
	<h3 class="g-header">Gender</h3>

	<div class="radio radio-inputs">
		<label class="d-radio"><input type="radio" name="gender" value="m" id="male"><strong>Male</strong></label>
	</div>
	<div class="radio radio-inputs">
		<label><input type="radio" name="gender" value="f" id="female"><strong>Female</strong></label>
	</div>


</div>


	<div class="form-group">
		<label for="">Count half days ?</label>
		<input type="checkbox" id="count_days" name="count_days" class="count-template">
	</div>




<div class="form-group time-control">

	<div class="radio radio-inputs">
		<input type="checkbox" name="count_start_half_day" value="1" id="start"><strong class="count-start">Leave start half day not counted</strong></label>
	</div>
	<div class="radio radio-inputs">
		<label><input type="checkbox" name="count_end_half_day" value="1" id="end"><strong class="count-start">Leave end half day not counted</strong></label>
	</div>

</div>

<div class="radio radio-back">
	<label class="d-radio back-layout"><input type="checkbox" name="back-stop" value="1" id="back-stop"><span class="count-template" style="padding-left: 5px">Leave requires back-stopping</span></label>
</div>



<div class="radio radio-layout-2">
	<label class="d-radio-layout"><input type="checkbox" name="carried_forward" value="1" id="carried_forward"><span class="count-template" style="padding-left: 5px">Leave can be carried forward</span></label>
</div>

<div class="radio radio-layout-2">
	<label class="d-radio-layout"><input type="checkbox" name="encashed" value="1" id="encashed"><span class="count-template" style="padding-left: 5px">Leave can be encashed</span></label>
</div>




<div class="pull-right">
	<button class="btn btn-success btn-flat" type="submit" value="Save">Save</button>
	<a href="{{ asset('/leave-types') }}" type="button" class="btn btn-default btn-flat">Cancel</a>
</div>



<script type="text/javascript">
    $("#staffs,#designation,#staff_id").select2();
    $(document).ready(function () {
		$('.dept-control').hide();
		$('.staff-control').hide();
		$('.gender-control').hide();
        $('.time-control').hide();
        $('.back-stop').hide();
    })
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
</script>

