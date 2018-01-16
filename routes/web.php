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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users/status/{suspendedStatus?}', 'UserController@findUsersByStatus');
Route::get('/users/search/{email}', 'UserController@findByEmail');
Route::get('/users/count', 'UserController@countUsers');
Route::resource('users', 'UserController');


Route::get('/tasks/list/{id}', 'TaskController@findByListId');
Route::get('/tasks/count/yesterday', 'TaskController@countCreatedYesterday');
Route::get('/tasks/count/open', 'TaskController@countOpenTasks');
Route::get('/tasks/count/closed', 'TaskController@countClosedTasks');
Route::resource('tasks', 'TaskController');
Route::get('/tasks/{id}/active', 'TaskController@findByListIdActiveOnly');

Route::get('/lists/user/{id}/count', 'ToDoListController@countUserLists');
Route::get('/lists/count/yesterday', 'ToDoListController@countCreatedYesterday');
Route::get('/lists/count', 'ToDoListController@countLists');
Route::resource('lists', 'ToDoListController');
Route::post('/lists/{id}/copy', 'ToDoListController@createCopyTasks');
Route::get('/lists/findBy/{userEmail}', 'ToDoListController@findListByUsername');

Route::post('emails/users', 'EmailController@emailActiveUsers');
Route::resource('emails', 'EmailController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
