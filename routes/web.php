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


Route::get('/pipeline/{id}', 'PipelineController@structure');
Route::get('/pipeline/{id}/nodes', 'PipelineController@nodes');

Route::get('/nodes/create/{ancestor_node_id}', 'NodeController@create');
Route::post('/nodes/store', 'NodeController@store');
Route::delete('/nodes/{id}', 'NodeController@destroy');
