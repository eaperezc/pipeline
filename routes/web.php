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


/*
|--------------------------------------------------------------------------
| Pipeline Node Management Routes
|--------------------------------------------------------------------------
|
| Here is where we add all the routes for the node management in the
| pipeline diagram. With this routes we can modify every node to
| get the right process that we want to run
|
*/
Route::group(['middleware' => ['auth']], function () {

    Route::get      ('/pipeline',                               'PipelineController@index');
    Route::get      ('/pipeline/create',                        'PipelineController@store');
    Route::get      ('/pipeline/{pipeline}',                    'PipelineController@diagram');
    Route::get      ('/pipeline/{pipeline}/structure',          'PipelineController@structure');
    Route::post     ('/pipeline/{pipeline}/change_name',        'PipelineController@changeName');
    Route::post     ('/pipeline/{pipeline}/nodes',              'NodeController@store');
    Route::delete   ('/pipeline/{pipeline}/nodes/{node}',       'NodeController@destroy');
    Route::get      ('/pipeline/{pipeline}/messages',           'MessageController@index');
    Route::get      ('/pipeline/{pipeline}/messages/{message}', 'MessageController@view');

});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| The routes in here are the ones that will generate all routes necessary
| to register, login, reset password and everything related to auth.
|
*/
Auth::routes();
Route::get      ('/home', 'HomeController@index');
