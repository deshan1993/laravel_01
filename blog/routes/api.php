<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add-module','modulesController@addModule');
Route::post('edit-module','modulesController@editModule');
Route::get('view-module','modulesController@viewModule');
Route::post('delete-module','modulesController@deleteModule');

Route::post('register-users','UserController@registerUser');
Route::get('view-users','UserController@getUserDetails');
Route::post('update-users','UserController@updateDetails');
Route::post('get-details','UserController@getSpecificData');
Route::post('delete-users','UserController@deleteData');
Route::post('enable-users','UserController@enableUsers');

Route::post('insert-roles','roleController@insertRole');
Route::get('view-roles','roleController@viewRoles');
Route::post('update-role','roleController@updateRole');
Route::post('delete-role','roleController@deleteRole');
Route::post('update-status','roleController@updateStatus');
