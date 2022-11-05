<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', 'HomeController@test')->name('test');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function() {
   Route::get('/tutorials', 'AdminController@index')->name('tutorials');
   Route::get('/add_tutorial', 'AdminController@create')->name('add_tutorial');
   Route::post('/add_tutorial', 'AdminController@store')->name('add_tutorial');
   Route::get('/tutorial/edit/{id}', 'AdminController@edit')->name('edit_tutorial'); 
   Route::post('/tutorial/edit/{id}', 'AdminController@store')->name('edit_tutorial');
   Route::delete('/tutorial/delete/{id}', 'AdminController@destroy')->name('delete_tutorial'); 
   Route::get('/teachers', 'AdminController@get_teachers')->name('teachers'); 
   Route::get('/add_teacher', 'AdminController@add_teacher')->name('add_teacher'); 
   Route::Post('/add_teacher', 'AdminController@store_teacher')->name('add_teacher');
   Route::get('/teacher/edit/{id}', 'AdminController@edit_teacher')->name('edit_teacher'); 
   Route::post('/teacher/edit/{id}', 'AdminController@store_teacher')->name('edit_teacher');
   Route::delete('/teacher/delete/{id}', 'AdminController@destroy_teacher')->name('delete_teacher');
   Route::get('/chapters', 'AdminController@get_chapters')->name('chapters'); 
   Route::get('/add_chapter', 'AdminController@add_chapter')->name('add_chapter'); 
   Route::Post('/add_chapter', 'AdminController@store_chapter')->name('add_chapter');
   Route::get('/chapter/edit/{id}', 'AdminController@edit_chapter')->name('edit_chapter'); 
   Route::post('/chapter/edit/{id}', 'AdminController@store_chapter')->name('edit_chapter');
   Route::delete('/chapter/delete/{id}', 'AdminController@destroy_chapter')->name('delete_chapter');
   Route::get('/get_teachers_sub_class/{class_id}/{subject_id}', 'AdminController@get_teachers_sub_class')->name('subject_class_wise_teacher');
   Route::get('/get_chapter_teacher_sub_class/{class_id}/{subject_id}/{teacher_id}', 'AdminController@get_chapter_teacher_sub_class')->name('subject_class_teacher_wise_chapter');
});

