<?php

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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');

Route::resource('roles', 'RoleController');
Route::get('/roles/{id}/delete','RoleController@delete')->name('roles.delete');

Route::resource('members', 'MemberController');
Route::get('/members/{id}/delete','MemberController@delete')->name('members.delete');

Route::resource('projects','ProjectController');
Route::post('/project/update','ProjectController@updateMembers')->name('project.updateMembers');
Route::get('/project/{id}/{sprintId?}','ProjectController@show')->name('projects.show');
Route::get('/getDataChart','ProjectController@getDataChart');

Route::post('/sprints/store','ProjectController@storeSprint')->name('sprints.store');

Route::post('/tasks/store','ProjectController@storeTask')->name('tasks.store');
Route::post('/tasks/update','ProjectController@updateTask');

Route::post('/subtasks/store','ProjectController@storeSubtask')->name('subtasks.store');