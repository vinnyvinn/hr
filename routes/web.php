<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route::get('/', 'HomeController@index');
//pusher
Route::get('users/event-user', 'UserController@user');

//Autocomplete
Route::get('autocomplete/users', 'AutoCompleteController@users');
Route::get('autocomplete/leave_types', 'AutoCompleteController@leave_types');
Route::get('autocomplete/departments', 'AutoCompleteController@departments');
Route::get('autocomplete/designation_items', 'AutoCompleteController@designation_items');
Route::get('autocomplete/document_types', 'AutoCompleteController@document_types');
Route::get('autocomplete/roles', 'AutoCompleteController@roles');

//Route::resource('absences', 'AbsenceController');
Route::get('absences', 'AbsenceController@index');
Route::get('absences/search', 'AbsenceController@search');
Route::get('absences/create', 'AbsenceController@create');
Route::post('absences', 'AbsenceController@store');
Route::get('absences/{absence}', 'AbsenceController@show');
Route::get('absences/{absence}/edit', 'AbsenceController@edit');
Route::patch('absences/{absence}', 'AbsenceController@update');
Route::delete('absences/{absence}', 'AbsenceController@destroy');

//Route::resource('attendances', 'AttendanceController');
Route::get('attendances', 'AttendanceController@index');
Route::get('attendances/search', 'AttendanceController@search');
Route::get('attendances/create', 'AttendanceController@create');
Route::post('attendances', 'AttendanceController@store');
Route::get('attendances/{attendance}', 'AttendanceController@show');
Route::get('attendances/{attendance}/edit', 'AttendanceController@edit');
Route::patch('attendances/{attendance}', 'AttendanceController@update');
Route::delete('attendances/{attendance}', 'AttendanceController@destroy');

//Awards
Route::resource('awards', 'AwardController');
Route::get('awards/search', 'AwardController@search');

Route::resource('bank-accounts', 'BankAccountController');
Route::get('bank-accounts/search', 'BankAccountController@search');

//medical details
Route::resource('medical-details','MedicalController');
//company branches
Route::resource('branches','BranchController');
Route::get('fetch-cities','BranchController@getCities');
//employee statutory details
//Route::resource('statutory-details','StatutoryDetailsController');
//company offences
Route::resource('offences','CompanyOffenceController');
//job-groups
Route::resource('job-groups','JobGroupController');
//education
Route::resource('education','EducationController');
//training types
Route::resource('training-types','TrainingTypeController');
//training
Route::resource('trainings','TrainingController');
//vehicle details
Route::resource('vehicle-details','VehicleController');
//travel-perdiem
Route::resource('travel-perdiem','TravelPerdiemController');
Route::get('get-users/{id}','TravelPerdiemController@getUsers');
Route::get('get-more-users/{id}','TravelPerdiemController@moreUsers');
//travel-mode
Route::resource('travel-mode','TravelModeController');
//travel-request
Route::resource('travel-request','TravelRequestController');
//travel request process
Route::get('travel-request/process/{travel}','GeneralController@processTravelRequest');
Route::patch('travel-request/process/{travel}','GeneralController@updateTravelRequest');
Route::get('travel-expenses','TravelExpensesController@index');

//Route::resource('cut-offs', 'CutOffController');
Route::get('cut-offs', 'CutOffController@index');
Route::get('cut-offs/search', 'CutOffController@search');
Route::get('cut-offs/create', 'CutOffController@create');
Route::post('cut-offs', 'CutOffController@store');
Route::get('cut-offs/{cut_off}', 'CutOffController@show');
Route::get('cut-offs/{cut_off}/edit', 'CutOffController@edit');
Route::patch('cut-offs/{cut_off}', 'CutOffController@update');
Route::delete('cut-offs/{cut_off}', 'CutOffController@destroy');

//Appraisal module routes
Route::get('appraisal-questions', 'AppraisalController@index');
Route::get('question-types', 'AppraisalController@index_question_type');

Route::post('question-types-store', 'AppraisalController@store_question_type');
Route::post('question-store', 'AppraisalController@store');
Route::get('question-types/create', 'AppraisalController@question_type_create');
Route::get('appraisal-questions/create', 'AppraisalController@create');
Route::get('appraisal-template', 'AppraisalController@index_template');
Route::get('appraisal-template/create', 'AppraisalController@create_template');
Route::post('appraisal-template-store', 'AppraisalController@store_template');
Route::get('active-appraisals', 'AppraisalController@active_appraisal');
Route::get('user-active-appraisals', 'AppraisalController@active_appraisal_user');
Route::get('activate-appraisal', 'AppraisalController@activate_appraisal');
Route::post('finailize-appraisal-activation', 'AppraisalController@finalize_appraisal_activation');
Route::post('process-finailization', 'AppraisalController@process_finalization');
Route::get('user-perform-appraisal/{id}', 'AppraisalController@perform_appraisal');
Route::get('perform-appraisal/{id}', 'AppradministratoraisalController@perform_appraisal');
Route::post('process-appraisal', 'AppraisalController@process_appraisal');

//Questions Controller

Route::resource('quiz','QuestionsController');
Route::get('quiz/app/{id}','QuestionsController@editAppr');
Route::get('quiz/updated/{id}','QuestionsController@updateAppr');
Route::get('quiz/remove/{id}','QuestionsController@remove');
Route::get('quiz/edit-temp/{id}','QuestionsController@editTemp');
Route::get('quiz/update-temp/{id}','QuestionsController@updateTemp');
Route::get('quiz/remove-temp/{id}','QuestionsController@removeTemp');
//Route::resource('departments', 'DepartmentController');
Route::get('departments', 'DepartmentController@index');
Route::get('departments/search', 'DepartmentController@search');
Route::get('departments/create', 'DepartmentController@create');
Route::post('departments', 'DepartmentController@store');
Route::get('departments/{department}', 'DepartmentController@show');
Route::get('departments/{department}/edit', 'DepartmentController@edit');
Route::patch('departments/{department}', 'DepartmentController@update');
Route::delete('departments/{department}', 'DepartmentController@destroy');
Route::get('sub-department', 'DepartmentController@SubDepartment');
Route::post('sub-add', 'DepartmentController@addSub');
Route::get('sub-edit/{id}', 'DepartmentController@editSubDepartment');
Route::post('update-sub', 'DepartmentController@updateSub');
Route::post('delete-sub/{id}', 'DepartmentController@deleteSub');


Route::get('departments/{department}/designation-items/create', 'DesignationItemController@create');
Route::post('departments/{department}/designation-items', 'DesignationItemController@store');
Route::get('departments/{department}/designation-items/{designation_item}/edit', 'DesignationItemController@edit');
Route::patch('departments/designation-items/{designation_item}', 'DesignationItemController@update');

Route::delete('departments/{department}/designation-items/{designation_item}', 'DesignationItemController@destroy');

//Designations
Route::resource('designations', 'DesignationController');
Route::get('designations/search', 'DesignationController@search');


Route::resource('designation-items', 'DesignationItemController');
Route::get('designation-items/search', 'DesignationItemController@search');


//Documents
Route::resource('all-documents', 'DocumentController');
Route::get('documents/search', 'DocumentController@search');


//Route::resource('document-types', 'DocumentTypeController');
Route::get('document-types', 'DocumentTypeController@index');
Route::get('document-types/search', 'DocumentTypeController@search');
Route::get('document-types/create', 'DocumentTypeController@create');
Route::post('document-types', 'DocumentTypeController@store');
Route::get('document-types/{document_type}', 'DocumentTypeController@show');
Route::get('document-types/{document_type}/edit', 'DocumentTypeController@edit');
Route::patch('document-types/{document_type}', 'DocumentTypeController@update');
Route::delete('document-types/{document_type}', 'DocumentTypeController@destroy');

//Route::resource('events', 'EventController');
Route::get('events', 'EventController@index');
Route::get('events/search', 'EventController@search');
Route::get('events/create', 'EventController@create');
Route::post('events', 'EventController@store');
Route::get('events/{event}', 'EventController@show');
Route::get('events/{event}/edit', 'EventController@edit');
Route::patch('events/{event}', 'EventController@update');
Route::delete('events/{event}', 'EventController@destroy');

//Expenses
Route::resource('expenses', 'ExpenseController');
Route::get('expenses/search', 'ExpenseController@search');

//Route::resource('holidays', 'HolidayController');
Route::get('holidays', 'HolidayController@index');
Route::get('holidays/search', 'HolidayController@search');
Route::get('holidays/create', 'HolidayController@create');
Route::post('holidays', 'HolidayController@store');
Route::get('holidays/{holiday}', 'HolidayController@show');
Route::get('holidays/{holiday}/edit', 'HolidayController@edit');
Route::patch('holidays/{holiday}', 'HolidayController@update');
Route::delete('holidays/{holiday}', 'HolidayController@destroy');

//Route::resource('leaves', 'LeaveController');
Route::get('leaves', 'LeaveController@index');
Route::get('leaves/search', 'LeaveController@search');
Route::get('leaves/create', 'LeaveController@create');
Route::post('leaves', 'LeaveController@store');
Route::get('leaves/{leave}', 'LeaveController@show');
Route::get('leaves/{leave}/edit', 'LeaveController@edit');
Route::get('remaining-days/{leave_type}', 'LeaveController@daysRemaining');
Route::get('user-days/{leave_type}', 'LeaveController@userDays');
Route::patch('leaves/{leave}', 'LeaveController@update');
Route::delete('leaves/{leave}', 'LeaveController@destroy');
Route::get('get-leave-type/{id}','LeaveController@getLeaveType');
Route::get('approve-leave/{leave}', 'LeaveController@Approve');
Route::get('reject-leave/{leave}', 'LeaveController@Reject');
Route::get('leaves-calendar', 'LeaveController@leaveCalender');
Route::resource('leaves-onbehalf','LeavesOnbehalfController');


Route::resource('leave-types', 'LeaveTypeController');
Route::get('leave-types', 'LeaveTypeController@index');
Route::get('leave-types/search', 'LeaveTypeController@search');
Route::get('leave-types/create', 'LeaveTypeController@create');
Route::post('leave-types', 'LeaveTypeController@store');
Route::get('leave-types/{leave_type}', 'LeaveTypeController@show');
Route::get('leave-types/{leave_type}/edit', 'LeaveTypeController@edit');
Route::post('leave-types/changed', 'LeaveTypeController@update');
Route::delete('leave-types/{leave_type}', 'LeaveTypeController@destroy');
Route::get('assign-leave', 'LeaveTypeController@assignLeave');
Route::get('users-attached/{leave_id}','LeaveTypeController@usersAttachedApi');
Route::post('leave-days','LeaveTypeController@saveDays');
Route::get('back-stop/{id}','LeaveTypeController@backStop');

//leave Balance resource
Route::resource('leave-balance','LeaveBalanceController');
Route::get('delete/leave-balance/{id}','LeaveBalanceController@destroy');


//Route::resource('notices', 'NoticeController');
Route::get('notices', 'NoticeController@index');
Route::get('notices/search', 'NoticeController@search');
Route::get('notices/create', 'NoticeController@create');
Route::post('notices', 'NoticeController@store');
Route::get('notices/{notice}', 'NoticeController@show');
Route::get('notices/{notice}/edit', 'NoticeController@edit');
Route::patch('notices/{notice}', 'NoticeController@update');
Route::delete('notices/{notice}', 'NoticeController@destroy');

//Route::resource('roles', 'RoleController');
Route::get('roles', 'RoleController@index');
Route::get('roles/search', 'RoleController@search');
Route::get('roles/create', 'RoleController@create');
Route::post('roles', 'RoleController@store');
Route::get('roles/{role}', 'RoleController@show');
Route::get('roles/{role}/edit', 'RoleController@edit');
Route::patch('roles/{role}', 'RoleController@update');
Route::delete('roles/{role}', 'RoleController@destroy');

//contract templates
Route::resource('contract-template','ContractTemplateController');
Route::post('contract-template/update/{id}','ContractTemplateController@updateTemplate');

//contracts
Route::resource('contracts','ContractController');
Route::get('cancel-contract','ContractController@teminateContract');
Route::post('update-contract','ContractController@initTerminate');
Route::get('renew-contract','ContractController@renewContract');
Route::post('renew-update','ContractController@updateRenewal');
Route::get('renewed-contracts','ContractController@renewedContracts');
Route::get('cancelled-contracts','ContractController@cancelledContracts');
Route::post('add-reason','ContractController@Reason');

//Loans/Advance

Route::resource('loans','LoansController');
Route::get('loan-amount/{id}','LoansController@loanAmount');
Route::post('update-amount/{id}','LoansController@updateAmount');
Route::post('reject-loan/{id}','LoansController@rejectLoan');

//Assets
Route::resource('asset-types','AssetTypesController');
Route::resource('assets','AssetsController');

Route::get('all-requested-assets','AssetsController@allAssetsRequested');
Route::get('request-asset','AssetsController@requestedAsset');
Route::post('request-save','AssetsController@saveRequest');
Route::get('return-asset','AssetsController@returnAsset');
Route::post('return-save','AssetsController@saveAsset');
Route::get('asset-requests','AssetsController@assetRequests');
Route::get('asset-details/{id}','AssetsController@assetDetails');
Route::post('approve-request/{id}','AssetsController@approveRequest');
Route::post('reject-request/{id}','AssetsController@rejectRequest');

//Route::resource('users', 'UserController');
Route::get('users', 'UserController@index');
Route::get('users/search', 'UserController@search');
Route::get('users/create', 'UserController@create');
Route::post('users', 'UserController@store');
Route::get('users/{user}', 'UserController@show');
Route::get('users/{user}/edit', 'UserController@edit');
Route::patch('users/{user}', 'UserController@update');
Route::delete('users/{user}', 'UserController@destroy');

Route::get('users/{user}/absences/create', 'AbsenceController@create');
Route::post('users/{user}/absences', 'AbsenceController@store');
Route::get('users/{user}/attendances/cut-off', 'AttendanceController@getUserAttendanceByCutOff');
Route::get('users/{user}/attendances/create', 'AttendanceController@createBulk');
Route::get('users/{user}/attendances/create/cut-off/{cut_off}', 'AttendanceController@createByCutOff');
Route::post('users/{user}/attendances/create/cut-off', 'AttendanceController@createByCutOffRedirect');
Route::post('users/{user}/attendances', 'AttendanceController@storeBulk');
Route::get('users/{user}/awards/create', 'AwardController@create');
Route::post('users/{user}/awards', 'AwardController@store');
Route::get('users/{user}/documents/create', 'DocumentController@create');
Route::post('users/{user}/documents', 'DocumentController@store');
Route::get('users/{user}/expenses/create', 'ExpenseController@create');
Route::post('users/{user}/expenses', 'ExpenseController@store');
Route::get('users/{user}/leaves/create', 'LeaveController@create');
Route::post('users/{user}/leaves', 'LeaveController@store');
Route::get('users/{user}/bank-account/create', 'BankAccountController@create');
Route::post('users/{user}/bank-account', 'BankAccountController@store');
Route::get('users/{user}/bank-account/{bank_account}/edit', 'BankAccountController@edit');
Route::patch('users/{user}/bank-account/{bank_account}', 'BankAccountController@update');



//Route::resource('job-vacancies', 'JobVacancyController');
Route::get('job-vacancies', 'JobVacancyController@index');
Route::get('job-vacancies/search', 'JobVacancyController@search');
Route::get('job-vacancies/create', 'JobVacancyController@create');
Route::post('job-vacancies', 'JobVacancyController@store');
Route::get('job-vacancies/{job_vacancy}', 'JobVacancyController@show');
Route::get('job-vacancies/{job_vacancy}/edit', 'JobVacancyController@edit');
Route::patch('job-vacancies/{job_vacancy}', 'JobVacancyController@update');
Route::delete('job-vacancies/{job_vacancy}', 'JobVacancyController@destroy');


//Hierachy
Route::resource('hierachy','HierachyController');

//Recruitment
Route::resource('candidates', 'CandidateController');
Route::get('candidates/search', 'CandidateController@search');
Route::get('candidates/{candidate}/download', 'CandidateController@download');
Route::post('candidate-process','CandidateController@updateRecruitment');

//Route employee recruitment process
Route::resource('recruitment','RecruitmentController');
Route::resource('recruitment-type','RecruitmentTypesController');
//REPORTS
Route::get('absence-reports/create', 'AbsenceReportController@create');
Route::post('reports/absence', 'AbsenceReportController@store');
Route::get('attendance-reports/create', 'AttendanceReportController@create');
Route::post('reports/attendance', 'AttendanceReportController@store');
Route::get('awards-reports/create', 'AwardReportController@create');
Route::post('reports/awards', 'AwardReportController@store');
Route::get('bankAccounts-reports/create', 'BankAccountReportController@create');
Route::post('reports/bankAccounts', 'BankAccountReportController@store');
Route::get('employees-reports/create', 'EmployeeReportController@create');
Route::post('reports/employees', 'EmployeeReportController@store');

Route::get('events-reports/create', 'EventReportController@create');
Route::post('reports/events', 'EventReportController@store');
Route::get('expenses-reports/create', 'ExpenseReportController@create');
Route::post('reports/expenses', 'ExpenseReportController@store');
Route::get('leaves-reports/create', 'LeaveReportController@create');
Route::post('reports/leaves', 'LeaveReportController@store');
Route::get('recruitments-reports/create', 'RecruitmentReportController@create');
Route::post('reports/recruitments', 'RecruitmentReportController@store');
Route::get('departments-reports/create', 'DepartmentReportController@create');
Route::post('reports/departments', 'DepartmentReportController@store');

//Appraisals
Route::resource('appraisal-master','AppraisalMasterController');
Route::resource('template-app','AppraisalTemplateController');
Route::post('assign-template','AppraisalMasterController@assignTemplate');
Route::get('staff-by-designation/{id}','AppraisalMasterController@getStaffByDesignation');
Route::get('all-staff/{designation_id}','AppraisalMasterController@getAllStaff');
Route::get('get-designations/{id}','AppraisalMasterController@getDesignations');
Route::get('copy-new/{id}','AppraisalMasterController@copyNew');
Route::get('delete-bulk','AppraisalMasterController@deleteBulk');
Route::get('check-template/{id}','AppraisalMasterController@checkTemplate');
Route::get('appraisal-status/{id}','AppraisalMasterController@appraisalStatus');
Route::get('get-questions/{id}','AppraisalMasterController@getQuestions');


//Appraisals Processing
Route::resource('processing','AppraisalProcessingController');
Route::get('finalize-appraisal/{id}','AppraisalProcessingController@finalizeAppraisal');
Route::post('final-update/{id}','AppraisalProcessingController@finalUpdate');
Route::post('update-appraisal','AppraisalProcessingController@updateAppraisal');
Route::get('approve-appraisal/{id}','AppraisalProcessingController@ApproveAppraisal');
Route::get('reject-appraisal/{id}','AppraisalProcessingController@rejectAppraisal');
Route::get('show-appraisal/{id}','AppraisalProcessingController@showAppraisal');

//Travel Plan
Route::resource('travels','TravelPlanController');
Route::get('get-modes','TravelPlanController@getModes');
Route::get('approve-travel/{id}','TravelPlanController@approveTravel');
Route::get('reject-travel/{id}','TravelPlanController@rejectTravel');

//Hotels
Route::resource('hotels','HotelsController');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Route::get('get-designations','AppraisalMasterController@getDesignations');
Route::get('get-rooms/{room}','HotelsController@getRooms');


//Permissions
Route::resource('permissions','PermissionsController');

Route::group(['prefix' => 'api'], function()
{
    Route::group(['prefix' => 'v1'], function()
    {
        Route::get('department', 'apiController@department');
        Route::get('employees', 'apiController@employees');
        Route::get('leaves', 'apiController@leaves');
        Route::get('attendance', 'apiController@attendance');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
