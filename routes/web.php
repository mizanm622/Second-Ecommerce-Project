<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Auth::routes();

Route::get('/login', function(){
    return redirect()->back();
})->name('login');

// Route::get('/register', function(){
//     return redirect()->to('/');
// })->name('register');

Route::group(['namespace' => 'App\Http\Controllers',],function(){

    Route::get('/home', 'HomeController@index')->name('home');


});

Route::group(['namespace' => 'App\Http\Controllers\User',],function(){

    Route::get('/', 'HomeController@index');
    Route::get('product/details/{id}', 'HomeController@singleView')->name('product.details');
    Route::post('/product/review', 'ReviewController@store')->name('product.review');
    Route::get('/product/wishlist', 'HomeController@addWishlist')->name('add.wishlist');
    Route::get('/user/logout', 'HomeController@logout')->name('user.logout');
    Route::get('/modal/view/{id}', 'HomeController@modalView');


});

Route::group(['namespace' => 'App\Http\Controllers\User',],function(){


    Route::get('user/registration', 'UserController@register')->name('user.register');
    Route::post('user/create', 'UserController@create')->name('user.create');
    Route::get('user/profile', 'UserController@userProfile')->name('user.profile');
    // Route::get('/user/logout', 'UserController@logout')->name('user.logout');
    // Route::get('user/reset-password', 'UserController@changePasswrd')->name('user.resetpassword');
    // Route::post('user/update-password', 'UserController@updatePasswrd')->name('user.password.update');


});


