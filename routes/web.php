<?php

use Illuminate\Support\Facades\Route;

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

Route::get('test', 'testController@test');
Route::resource("/customer", "customerController");
Route::resource("/investor", "investorController");

Route::get('/personnel', 'personnelController@index');
Route::get('/personnel/create', 'personnelController@create')->name('personnels.create'); //option 1 best for me
Route::post('/personnel/store', ['uses' => 'personnelController@store', 'as' => 'personnels.store']); //option 2
Route::get('/personnel/edit/{id}', 'personnelController@edit')->name('personnels.edit');
Route::post('/personnel/update{id}', ['uses' => 'personnelController@update', 'as' => 'personnels.update']);
Route::delete('/personnel/destroy/{id}', ['uses' => 'personnelController@destroy', 'as' => 'personnels.destroy']);