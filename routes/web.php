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

Route::prefix('users')->group(function () {
  Route::get('/lists/count', 'UserController@getAllWithListsCount');
  Route::get('/status/{suspendedStatus?}', 'UserController@findUsersByStatus');
  Route::get('/search/{email}', 'UserController@findByEmail');
  Route::get('/count', 'UserController@countUsers');
});
Route::resource('users', 'UserController');

Route::prefix('tasks')->group(function () {
  Route::get('/list/{id}', 'TaskController@findByListId');
  Route::get('/count/yesterday', 'TaskController@countCreatedYesterday');
  Route::get('/count/open', 'TaskController@countOpenTasks');
  Route::get('/count/closed', 'TaskController@countClosedTasks');
  Route::get('/{id}/active', 'TaskController@findByListIdActiveOnly');
});
Route::resource('tasks', 'TaskController');

Route::prefix('lists')->group(function () {
  Route::get('/users/{id}', 'ToDoListController@getListsByUserId');
  Route::get('/tasks/count', 'ToDoListController@getAllWithTasksAndCount');
  Route::get('/user/{id}/count', 'ToDoListController@countUserLists');
  Route::get('/count/yesterday', 'ToDoListController@countCreatedYesterday');
  Route::get('/count', 'ToDoListController@countLists');
  Route::post('/{id}/copy', 'ToDoListController@createCopyTasks');
  Route::get('/findBy/{userEmail}', 'ToDoListController@findListByUsername');
});
Route::resource('lists', 'ToDoListController');


Route::prefix('emails')->group(function () {
  Route::get('/users/{user_id}', 'EmailController@findByUserId');
  Route::post('/users', 'EmailController@emailActiveUsers');
});
Route::resource('emails', 'EmailController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
