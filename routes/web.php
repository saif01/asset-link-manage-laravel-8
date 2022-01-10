<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function(){
    return view('auth.login');
});

// Route::get('/home', 'App\Http\Controllers\AssetController@index')->name('index');

Route::get('/create', 'App\Http\Controllers\AssetController@create')->name('create');
Route::post('/save', 'App\Http\Controllers\AssetController@store')->name('store');

Route::get('/edit/{id}', 'App\Http\Controllers\AssetController@edit')->name('edit');
Route::put('/update/{id}', 'App\Http\Controllers\AssetController@update')->name('update');

Route::delete('/delete/{id}', 'App\Http\Controllers\AssetController@destroy')->name('delete');

Route::get('/status/{id}', 'App\Http\Controllers\AssetController@change_status')->name('status');



