<?php



Route::get('/', function () {
    return view('welcome');
});


Route::get('signUp', 'AdminController@signUp');   // send for form purpose

Route::post('signMe', 'AdminController@signMe');  // submit form function do here

Route::get('login', 'AdminController@login_form');

Route::post('loginme', 'AdminController@checklogin');

/**
 * For Authenticate Purpose
 */
Route::group(['middleware' => 'auth'], function(){

Route::get('userProfile', 'AdminController@getprofile');
Route::get('logOut', 'AdminController@logOut');

});









