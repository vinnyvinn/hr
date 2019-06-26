<?php

// routing for letters
Route::group(['middleware' => 'web'], function () {
	Route::resource('warning','Letters\Controllers\WarningController');
	Route::resource('issued','Letters\Controllers\IssuedWarningController');
	Route::post('warning-send','Letters\Controllers\WarningController@sendWarning');
	Route::resource('appreciation','Letters\Controllers\AppreciationController');
	Route::resource('issued-appreciation','Letters\Controllers\IssuedAppreciationController');

	Route::post('appreciation-send','Letters\Controllers\AppreciationController@sendAppreciation');
	Route::get('print-appreciation/{id}','Letters\Controllers\IssuedAppreciationController@printAppreciation');
	
	Route::resource('offer-template','Letters\Controllers\OfferLetersController');
	Route::resource('application-status','Letters\Controllers\ApplicationStatusController');

	Route::resource('offer-letter','Letters\Controllers\IssueOfferLettersController');
	Route::post('offers-candidate','Letters\Controllers\IssueOfferLettersController@getCandidate');
	
});