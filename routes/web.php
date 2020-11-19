<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'ajax' ,'as' => 'ajax.'], function () {
    Route::resource('/', 'CategoryController');
    Route::get('/read', 'CategoryController@readData')->name('list');
    Route::post('/delete', 'CategoryController@deleteData')->name('delete');
    Route::post('/delete/select', 'CategoryController@multiDelete')->name('multiDelete');
    Route::get('/edit', 'CategoryController@editData')->name('Edit');
    Route::post('/update', 'CategoryController@updatetData')->name('Update');
});
