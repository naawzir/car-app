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

/*Route::get('/', function () {
    return view('welcome');
});
    ->middleware('verified');*/

Route::get('/', ['middleware' =>'guest', function(){
    return view('welcome');
}]);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/cars')->group(function () {
    Route::get('/', 'CarsController@index');
    Route::get('/get-records', 'CarsController@getRecords');
    Route::get('/get-cars', 'CarsController@getCars');
    Route::get('/create', 'CarsController@create');
    Route::post('/create/', 'CarsController@store');
    Route::get('/{car}', 'CarsController@edit');
    Route::post('/{car}', 'CarsController@update');
    Route::get('/{car}/delete', 'CarsController@destroy');
});

Route::prefix('/owners')->group(function () {
    Route::get('/', 'OwnersController@index');
    Route::get('/get-records', 'OwnersController@getRecords');
    Route::get('/create', 'OwnersController@create');
    Route::post('/create/', 'OwnersController@store');
    Route::get('/{owner}', 'OwnersController@edit');
    Route::post('/{owner}', 'OwnersController@update');
});