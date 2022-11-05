<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('login-otp', 'AuthController@loginWithOtp');
    Route::post('verify-otp', 'AuthController@confirmLogin');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
		Route::get('search_tutorials/{user_id}/{class_id}/{subject_id}/{teacher_id}/{chapter_id}', 'ApiController@search_tutorials');
        Route::get('user', 'AuthController@user');
		Route::get('get_teachers/{class_id}/{subject_id}', 'ApiController@get_teachers');
		Route::get('get_chapters/{class_id}/{subject_id}/{teacher_id}', 'ApiController@get_chapters');
    });
});


Route::resource('order', 'OrderController')->middleware('auth:api');
Route::post('verify-payment', 'OrderController@verifyPayment')->middleware('auth:api');
