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

    $pipeline = App\Pipeline::first();
    return view('pipeline', [ 'pipeline' => $pipeline ]);

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

Route::get      ('/pipeline/{pipeline}',                'PipelineController@structure');
Route::post     ('/pipeline/{pipeline}/nodes',          'NodeController@store');
Route::delete   ('/pipeline/{pipeline}/nodes/{node}',   'NodeController@destroy');






