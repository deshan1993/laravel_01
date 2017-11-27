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

//for modules
Route::post('add-module','ModuleController@addModule');
Route::post('update-module','ModuleController@updateModule');
Route::get('view-module','ModuleController@viewModule');
Route::post('delete-module','ModuleController@deleteModule');

//for users
Route::post('register-users','UserController@registerUser');
Route::get('view-users','UserController@getUserDetails');
Route::post('update-users','UserController@updateDetails');
Route::post('get-details','UserController@getSpecificData');
Route::post('delete-users','UserController@deleteData');
Route::post('enable-users','UserController@enableUsers');

//for roles
Route::post('insert-role','RoleController@insertRole');
Route::get('view-role','RoleController@viewRoles');
Route::post('update-role','RoleController@updateRole');
Route::post('delete-role','RoleController@deleteRole');
Route::post('update-status','RoleController@updateStatus');

//for author
Route::post('insert-author','AuthorController@insertAuthor');
Route::get('view-author','AuthorController@viewAuthor');
Route::post('update-author','AuthorController@updateAuthor');
Route::post('delete-author','AuthorController@deleteAuthor');

//for category
Route::post('insert-category','CategoryController@insertCategory');
Route::get('view-category','CategoryController@viewCategory');
Route::post('update-category','CategoryController@updateCategory');
Route::post('delete-category','CategoryController@deleteCategory');

//for keywords
Route::post('insert-keyword','KeywordController@insertKeyword');
Route::get('view-keyword','KeywordController@viewKeyword');
Route::post('update-keyword','KeywordController@updateKeyword');
Route::post('delete-keyword','KeywordController@deleteKeyword');
