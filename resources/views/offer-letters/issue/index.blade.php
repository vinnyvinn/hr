@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<!-- Include Editor style. -->
@section('head')
<link rel="stylesheet" type="text/css" href="{{URL::to('note/summernote.css')}}"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Make An offer to the following Candidates
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="box box-success">
                        <div class="box-header">
    
                        </div>
                        <div class="box-body table-responsive no-padding">
                @if(!isset($candidates))
                 <div class="row col-md-8 col-md-offset-2">
                        <form  action="{{ url('offers-candidate')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label> Job Vaccancy</label>
                                <select name="job_id" class="form-control">
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}"> {{ $job->job_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"> get Candidates </button>
                            </div>

                        </form>
                </div>
                @elseif(isset($candidates))


                <div class="row col-md-10 col-md-offset-1">
                    <table class="table table-responsive table-striped dataTable">
                        <thead>
                            <th>Candidate</th>
                            <th>Email</th>
                            <th>Contact number</th>
                            <th>Gender</th>
                            <th>Salary</th>
                            <th>Preview</th>
                            <th>Offer</th>
                        </thead>
                        <tbody>
                        @foreach($candidates as $candidate)
                            <tr>
                                <td>{{$candidate->first_name.' '.$candidate->last_name}}</td>
                                <td>{{$candidate->email}}</td>
                                <td>{{$candidate->contact_no}}</td>
                                <td>{{$candidate->gender}}</td>
                                <td>{{$candidate->salary}}</td>
                                <td>
                                    <a href="{{ url('candidates',['id'=>$candidate])}}" class="btn btn-success"> preview Candidate</a>
                                </td>
                                <td><a href="{{ url('offer-letter',['id'=>$candidate])}}" class="btn btn-success"> offer</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfooter>
                    @if(count($candidates) == 0)
                          <label class="label label-warning">  No qualified candidates for this job yet </label>
                    @endif
                        </tfooter>
                    </table>

                   
                    </div>


                @endif
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('foot')
<script type="text/javascript" src=" {{asset('note/summernote.min.js')}}"></script>
    <script type="text/javascript">
     $(document).ready(function() {
        $('#summernote').summernote({
            tabsize: 2, 
            height: 150
        });
      });


     jQuery(function($) {
         //initiate dataTables plugin
         var myTable =
             $('.dataTable')
             //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                 .DataTable( {
                     bAutoWidth: false,
                     "aoColumns": [
                         null,
                         null,
                         null,
                         null,
                         null,
                         null,
                         null

                     ],
                     "aaSorting": [],


                     //"bProcessing": true,
                     //"bServerSide": true,
                     //"sAjaxSource": "http://127.0.0.1/table.php"   ,

                     //,
                     //"sScrollY": "200px",
                     //"bPaginate": false,

                     //"sScrollX": "100%",
                     //"sScrollXInner": "120%",
                     //"bScrollCollapse": true,
                     //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                     //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                     //"iDisplayLength": 50


                     select: {
                         style: 'multi'
                     }
                 });
     });


    </script>

@endsection
