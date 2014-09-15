<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//route to homepage
Route::get('/', array('as' => 'index', 'uses'=>'HomeController@welcome'));
//route to register page
Route::get('register', function(){
	return View::make('register');
});
Route::get('about',function(){
	return View::make('about');
});
Route::get('hworks',function(){
	return View::make('hworks');
});

//route to thank for registration page
Route::get('thankyou',function(){
	return View::make('thankyou');
});

//route to do regsiter controller
Route::post('doRegister', array('uses'=>'HomeController@doRegister'));
//route to process email verfication
Route::get('email_verify/{code}', 'HomeController@verify_email');
//route to process login
Route::post('login', array('uses'=>'HomeController@doLogin'));
//rout to execute logout
Route::get('logout','HomeController@logout');
//Route to verify email
Route::get('email_verify','HomeController@verify_email');
//Route to process password reminder
Route::get('password/reminder', array('uses'=>'RemindersController@getRemind'));
//Rout to process password reset
Route::get('password/reset/{token}', array('uses'=>'RemindersController@getReset'));
//Route to process password reminder form 
Route::post('post',array('uses'=>'RemindersController@postRemind'));
//Route to porcess password reset form
Route::post('reset',array('uses'=>'RemindersController@postReset'));


//route to myprofile page
Route::get('profile', array('before'=>'guest', 'as'=>'myprofile', 'uses' => 'UserProfileController@profile'));

//Route to open editprofile page
Route::get('editprofile', array('brfore'=>'guest', 'as'=>'editProfile', 'uses'=> 'UserProfileController@editProfile'));

//route to process save profile
Route::post('saveProfile', 'UserProfileController@saveProfile');

Route::get('editLender', function() {
	return View::make('editLender');
});

Route::get('makebid/{loan_id}',array('before'=>'guest', 'as'=>'makebid', 'uses'=>'BidController@makeBid'));
//route to update myprofile form  FOR TEST PURPOSE
Route::get('myprofile_form', function(){
	return View::make('myprofile_form');
});

//route to process save Loan
Route::post('saveLoan', 'LoanAppController@saveLoanApp');
//route to process save Lend Pref
Route::post('saveLendPref', 'LenderPrefController@saveLendPref');
//route to process save financile profilef
Route::post('saveFinancialProfile','UserProfileController@saveFinancialProfile');

//Route to prcess the Ajax request to finish applying loan
Route::post('submitLoan','LoanAppController@applyLoans');
