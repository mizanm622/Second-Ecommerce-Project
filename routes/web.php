<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Auth::routes();

Route::get('/login', function(){
    return redirect()->back();
})->name('login');

// Route::get( Routes());


Route::group(['namespace' => 'App\Http\Controllers',],function(){

    Route::get('/home', 'HomeController@index')->name('home');


});

Route::group(['namespace' => 'App\Http\Controllers\User',],function(){

    Route::get('/', 'HomeController@index');
    Route::get('product/details/{id}', 'HomeController@singleView')->name('product.details');
    Route::post('/product/review', 'ReviewController@store')->name('product.review');
    Route::get('/product/wishlist', 'HomeController@addWishlist')->name('add.wishlist');
    Route::get('/user/logout', 'HomeController@logout')->name('user.logout');
    Route::get('/modal/view', 'HomeController@modalView')->name('modal.view');

    Route::get('/category/product/{id}', 'HomeController@categoryProduct')->name('category.product');
    Route::post('/product/filter-by-price', 'HomeController@productPriceFilter')->name('price.filter');
    // Route::get('/category/product/{id}', 'HomeController@categoryProduct')->name('childcategory.product');




});

Route::group(['namespace' => 'App\Http\Controllers\User',],function(){

    Route::get('user/registration', 'UserController@register')->name('user.register');
    Route::post('user/create', 'UserController@create')->name('user.create');
    Route::post('change/password', 'UserController@changePassword')->name('user.change.password');
    Route::post('update/shipping/address', 'UserController@updateShippingAddress')->name('update.shipping.address');
    Route::get('user/profile', 'UserController@userProfile')->name('user.profile');
    // Route::get('/user/logout', 'UserController@logout')->name('user.logout');
    // Route::get('user/reset-password', 'UserController@changePasswrd')->name('user.resetpassword');
    // Route::post('user/update-password', 'UserController@updatePasswrd')->name('user.password.update');


});

// Cart Routes
Route::group(['namespace' => 'App\Http\Controllers\User',],function(){

    Route::get('/add-to-cart', 'CartController@addToCart')->name('add.to.cart');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/cart-item-remove/{id}', 'CartController@cartItemRemove')->name('cart.item.remove');
    Route::get('/quantity-update', 'CartController@updateQuantity')->name('cart.qty.update');
    Route::get('/size-update', 'CartController@updateSize')->name('cart.size.update');
    Route::get('/color-update', 'CartController@updateColor')->name('cart.color.update');
    Route::get('/cart-destroy', 'CartController@cartDestroy')->name('cart.item.destroy');


});
//chechout controller
Route::group(['namespace' => 'App\Http\Controllers\User',],function(){
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');
    Route::get('/check-coupon', 'CheckoutController@checkCoupon')->name('check.coupon');

});

//Wishlist Routes
Route::group(['namespace' => 'App\Http\Controllers\User',],function(){


    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::get('/product/wishlist', 'WishlistController@addWishlist')->name('add.wishlist');
    Route::get('/remove/wishlist/{id}', 'WishlistController@removeWishlist')->name('remove.wishlist');
    Route::get('/destroy/wishlist', 'WishlistController@destroyWishlist')->name('destroy.wishlist');



});



