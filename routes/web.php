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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'LinkController@show');

Route::get('/check', 'LinkController@store')->middleware('ModifiesUrlRequestData'); //change this to post request to /

Route::get('/stats', 'LinkStatsController@show');