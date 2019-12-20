<?php

use Illuminate\Http\Request;
use App\Department;
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


Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::get('/me','AuthController@me');
Route::get('/is-admin','AuthController@isAdmin');

Route::get('/department','DepartmentController@index');
Route::get('/showdept','DepartmentController@show');
Route::post('/insert','DepartmentController@insert');
Route::delete('/delete/{department}','DepartmentController@destroy');
Route::post('/update/{deptID}','DepartmentController@update');
Route::get('/department/show/{department}', 'DepartmentController@show');

Route::get('/question/{department}', 'QuestionController@index');
Route::post('/question/{department}/create', 'QuestionController@insert');
Route::put('/question/{question}/update', 'QuestionController@update');
Route::delete('/question/{question}/delete', 'QuestionController@destroy');
Route::get('/question/{question}/show', 'QuestionController@show');




