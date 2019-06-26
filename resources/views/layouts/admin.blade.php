<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CloudHr</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/dist/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/dist/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('/dist/css/skins/skin-green.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/pace/pace.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/dist/css/custom.css') }}">
	<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('/dist/css/toastr.min.css')}}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	@yield('head')
</head>
<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="{{ url('/') }}" class="logo">
				<span class="logo-mini"><b>C-</b>hr</span>
				<span class="logo-lg"><b>Cloud</b>hr</span>
			</a>

			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="{{ asset(Auth::user()->profile_picture) }}" class="user-image" alt="User Image">
							<span class="hidden-xs">{{ Auth::user() ? Auth::user()->first_name.' '.Auth::user()->last_name : '' }}</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="{{ asset(Auth::user()->profile_picture) }}" class="img-circle" alt="User Image">
									<p>
									{{ Auth::user() ? Auth::user()->first_name.' '.Auth::user()->last_name : '' }}
									<small>{{ Auth::user() && Auth::user()->designation_item ? Auth::user()->designation_item->designation_item : '' }}</small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		
		<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu">
					<li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
					<li class="treeview">
						<a href="#"><i class="fa fa-briefcase"></i><span>Company</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/branches') }}"><i class="fa fa-briefcase"></i> <span>Zones</span></a></li>
							<li><a href="{{ url('/departments') }}"><i class="fa fa-briefcase"></i> <span>Departments</span></a></li>
							<li><a href="{{ url('/designation-items') }}"><i class="fa fa-gavel"></i> <span>Designation Items</span></a></li>

						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-briefcase"></i><span>Employees</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/users') }}"><i class="fa fa-briefcase"></i> <span>Employees</span></a></li>
							<li><a href="{{ url('/bank-accounts') }}"><i class="fa fa-bank"></i> <span>Bank Accounts</span></a></li>
							<li><a href="{{ url('/medical-details') }}"><i class="fa fa-bank"></i> <span>Medical Details</span></a></li>
							<li><a href="{{ url('/awards') }}"><i class="fa fa-trophy"></i> <span>Awards</span></a></li>
							<li><a href="{{ url('/hierachy') }}"><i class="fa fa-trophy"></i> <span>Hierachy</span></a></li>
						</ul>
						</li>

					<li>
						<a href="#"><i class="fa fa-briefcase"></i><span>Loans/ Advance</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{url('loans/create')}}"><i class="fa fa-bank"></i> <span>Apply</span></a></li>
							<li><a href="{{url('loans')}}"><i class="fa fa-briefcase"></i> <span>Approvals</span></a></li>
							</ul>
					</li>

					<li>
						<a href="#"><i class="fa fa-briefcase"></i><span>Contracts</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{url('contract-template')}}"><i class="fa fa-briefcase"></i> <span>Template</span></a></li>
							<li><a href="{{url('contracts')}}"><i class="fa fa-bank"></i> <span>Issue</span></a></li>
							<li><a href="{{url('renew-contract')}}"><i class="fa fa-bank"></i> <span>Renew</span></a></li>
							<li><a href="{{url('cancel-contract')}}"><i class="fa fa-trophy"></i> <span>Termination</span></a></li>
							<li><a href="{{url('renewed-contracts')}}"><i class="fa fa-trophy"></i> <span>Renewed Contracts</span></a></li>
							<li><a href="{{url('cancelled-contracts')}}"><i class="fa fa-trophy"></i> <span>Terminated Contracts</span></a></li>
						</ul>
					</li>

					<li>
						<a href="#"><i class="fa fa-briefcase"></i><span>Assets</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{url('all-requested-assets')}}"><i class="fa fa-briefcase"></i> <span>Request</span></a></li>
							<li><a href="{{url('asset-requests')}}"><i class="fa fa-bank"></i> <span>Approve</span></a></li>
							<li><a href="{{url('return-asset')}}"><i class="fa fa-bank"></i> <span>Return</span></a></li>
							</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-briefcase"></i><span>Administration</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/events') }}"><i class="fa fa-calendar"></i> <span>Events</span></a></li>
							{{--<li><a href="{{ url('/expenses') }}"><i class="fa fa-money"></i> <span>Expenses</span></a></li>--}}
							<li><a href="{{ url('/holidays') }}"><i class="fa fa-tree"></i> <span>Holidays</span></a></li>
							<li><a href="{{ url('/notices') }}"><i class="fa fa-sticky-note-o"></i> <span>Notice</span></a></li>
							<li><a href="{{ url('/asset-types') }}"><i class="fa fa-sticky-note-o"></i> <span>Asset Types</span></a></li>
							<li><a href="{{ url('/assets') }}"><i class="fa fa-list-alt"></i> <span>Asset Listing</span></a></li>
							<li><a href="{{ url('/permissions') }}"><i class="fa fa-list-alt"></i> <span>Permissions</span></a></li>
							<li><a href="{{ url('/roles') }}"><i class="fa fa-list-alt"></i> <span>Roles</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-rocket"></i><span>Leaves</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/leaves') }}"><i class="fa fa-rocket"></i> <span>Leaves</span></a></li>
							<li><a href="{{ url('/leaves-onbehalf/create') }}"><i class="fa fa-rocket"></i> <span>Apply Onbehalf</span></a></li>
							<li><a href="{{ url('/leave-types') }}"><i class="fa fa-sun-o"></i> <span>Leave Types</span></a></li>
							<li><a href="{{ url('/leave-balance') }}"><i class="fa fa-sun-o"></i> <span>Opening Balance</span></a></li>
							<li><a href="{{ url('/assign-leave') }}"><i class="fa fa-sun-o"></i> <span>Assign  Leave</span></a></li>
							<li><a href="{{ url('/leaves-calendar') }}"><i class="fa fa-sun-o"></i> <span>Staff Leave Calendars</span></a></li>
							<li style="display: none"><a href="{{ url('/absences') }}"><i class="fa fa-user-times"></i> <span>Absences</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-envelope-o"></i><span>Letters</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{url('warning')}}"><i class="fa fa-envelope"></i> <span>Manage Warning</span></a></li>
							<li><a href="{{url('issued')}}"><i class="fa fa-envelope"></i> <span>Issued Warning</span></a></li>
							<hr/>
							<li><a href="{{ url('appreciation')}}"><i class="fa fa-arrow-right"></i> <span>Manage Appreciation</span></a></li>
							<li><a href="{{ url('issued-appreciation')}}"><i class="fa fa-arrow-left"></i> <span>Issue Appreciation</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-file"></i><span>Documents</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/all-documents') }}"><i class="fa fa-file"></i> <span>Documents</span></a></li>
							<li><a href="{{ url('/document-types') }}"><i class="fa fa-file-text"></i> <span>Document Types</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-file"></i><span>Recruitment</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/job-vacancies') }}"><i class="fa fa-circle-o"></i> <span>Vacancies</span></a></li>

							<li><a href="{{ url('/candidates') }}"><i class="fa fa-user"></i> <span>Candidates</span></a></li>
							<li><a href="{{ url('/recruitment') }}"><i class="fa fa-file-text"></i> <span>Recruitments</span></a></li>
							<li><a href="{{ url('/offer-letter') }}"><i class="fa fa-file"></i> <span>Offer Letters</span></a></li>
							<hr/>
							<li><a href="{{ url('/application-status') }}">
									<i class="fa fa-cog"></i> <span> Application Status</span></a></li>
							<li><a href="{{ url('/recruitment-type') }}"><i class="fa fa-file"></i> <span>Recruitment Types</span></a></li>

							<li><a href="{{ url('/offer-template') }}">
									<i class="fa fa-file"></i> <span>Offer Letters Templates</span></a></li>
						</ul>
					</li>
					<li class="treeview" style="display: none">
						<a href="#"><i class="fa fa-hand-paper-o"></i><span>Termination</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="#"><i class="fa fa-hand-paper-o"></i> <span>Termination Letter</span></a></li>
							<li><a href="#"><i class="fa fa-hand-paper-o"></i> <span>Issue Termination</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-hand-paper-o"></i><span>Travels</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/travel-perdiem') }}"><i class="fa fa-hand-paper-o"></i> <span>Travel Perdiems</span></a></li>
							<li><a href="{{ url('/travel-mode') }}"><i class="fa fa-hand-paper-o"></i> <span>Travel Modes</span></a></li>
							<li><a href="{{ url('/travels') }}"><i class="fa fa-hand-paper-o"></i> <span>Travel Plan</span></a></li>
							<li><a href="{{ url('/hotels') }}"><i class="fa fa-hand-paper-o"></i> <span>Hotels</span></a></li>
							<li style="display: none"><a href="{{ url('/travel-request') }}"><i class="fa fa-hand-paper-o"></i> <span>Travel Requests</span></a></li>
							<li style="display: none;"><a href="{{ url('/travel-expenses') }}"><i class="fa fa-hand-paper-o"></i> <span>Travel Expenses</span></a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-file"></i><span>Appraisal</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('question-types') }}"><i class="fa fa-circle-o"></i> <span>Question Types</span></a></li>
							<li><a href="{{ url('template-app') }}"><i class="fa fa-circle-o"></i> <span>Appraisal Templates</span></a></li>
							<li><a href="{{ url('appraisal-master') }}"><i class="fa fa-circle-o"></i> <span>Appraisals</span></a></li>
							<li style="display: none"><a href="{{ url('appraisal-template') }}"><i class="fa fa-circle-o"></i> <span>Appraisal Questionare Template</span></a></li>
							<li style="display: none"><a href="{{ url('active-appraisals') }}"><i class="fa fa-circle-o"></i> <span>ìnitiate Appraisals</span></a></li>
							<li><a href="{{ url('/processing') }}"><i class="fa fa-gavel"></i> <span>Process</span></a></li>

						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class="fa fa-clone"></i><span>Reports</span><i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/absence-reports/create') }}"><i class="fa fa-user-times"></i> <span>Absences</span></a></li>
							<li style="display: none;"><a href="{{ url('/attendance-reports/create') }}"><i class="fa fa-circle-o"></i> <span>Attendance</span></a></li>
							<li><a href="{{ url('/awards-reports/create') }}"><i class="fa fa-trophy"></i> <span>Awards</span></a></li>
							<li><a href="{{ url('/bankAccounts-reports/create') }}"><i class="fa fa-bank"></i> <span>Bank Accounts</span></a></li>
							<li><a href="{{ url('/employees-reports/create') }}"><i class="fa fa-users"></i> <span>Employees</span></a></li>
							<li><a href="{{ url('events-reports/create') }}"><i class="fa fa-calendar"></i> <span>Events</span></a></li>
							{{--<li><a href="{{ url('/expenses-reports/create') }}"><i class="fa fa-money"></i> <span>Expenses</span></a></li>--}}
							<li><a href="{{ url('/leaves-reports/create') }}"><i class="fa fa-rocket"></i> <span>Leaves</span></a></li>
							<li><a href="{{ url('/recruitments-reports/create') }}"><i class="fa fa-laptop"></i> <span>Recruitments</span></a></li>
							<li><a href="{{ url('/departments-reports/create') }}"><i class="fa fa-briefcase"></i> <span>Departments</span></a></li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>
		@yield('content')
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
			<strong class="text-green">ClourdHr</strong> Human Resource Management
			</div>
			<strong>Copyright &copy; <?php echo date('Y')?> <a href="http://www.wizag.biz/">Wise and Agile Solutions Limited</a></strong> All rights reserved.
		</footer>

	</div>

	<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>
	<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
	<script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
	<script src="{{asset('dist/js/toastr.min.js')}}"></script>
	<script>

		@if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")
		@endif

		@if(Session::has('fail'))
        toastr.warning("{{Session::get('fail')}}")
		@endif

	</script>

@yield('foot')
</body>
</html>
