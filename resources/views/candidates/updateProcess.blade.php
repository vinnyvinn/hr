<button class="btn btn-success btn-xs pull-right"  data-toggle="modal" data-target="#exampleModal">
								  Update 
</button> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Candidate Prefomance Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ url('candidate-process')}}">

      <div class="modal-body">
     				<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="candidate_id" value="{{$candidate->id}}">
					<input type="hidden" name="process_id" value="{{$level->id}}">
					<input type="hidden" name="recruitment_id" value="{{$nextLevels->recruitment_id}}">
					<div class="form-group">
						<label> Process</label>
						<input type="text" name="process" class="form-control" value="{{$level->process}}" readonly="true">
					</div>
					<div class="form-group">
						<label> Status</label>
						<select class="form-control" name="status" required="true">
							<option></option>
							@foreach($status as $sta)
								<option value="{{$sta->id}}"> {{ $sta->status}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label> Comment</label>
						<textarea name="comment" class="form-control" rows="5" required="true"></textarea>
					</div>

			

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
       </form>

      </div>
    </div>
  </div>
</div>