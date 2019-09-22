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

// Route::get('/', 'QueueController@index');

Route::get('/queues', 'QueueController@index');
Route::get('/queue/{queue}', 'QueueController@edit');
Route::post('/queue ', 'QueueController@save');
Route::delete('/queues/{queue}', 'QueueController@destroy');
