<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'App\Http\Controllers\User',],function(){

    Route::get('/', 'HomeController@index');
    Route::get('product/details/{id}', 'HomeController@singleView')->name('product.details');
    Route::get('user/reset-password', 'HomeController@changePasswrd')->name('user.resetpassword');
    Route::post('user/update-password', 'HomeController@updatePasswrd')->name('user.password.update');


});
