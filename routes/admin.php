<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');


//Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'],function(){

    Route::get('admin/home', 'AdminController@admin')->name('admin.home');
    Route::post('admin/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('admin/reset-password', 'AdminController@changePasswrd')->name('admin.resetpassword');
    Route::post('admin/update-password', 'AdminController@updatePasswrd')->name('admin.password.update');
    Route::get('admin/register', 'AdminController@adminRegister')->name('admin.register');
    Route::post('admin/create', 'AdminController@create')->name('admin.create');

    //category routes
    Route::group(['prefix'=>'category'], function(){
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('store.category');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('delete.category');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/update', 'CategoryController@update')->name('update.category');
    });

    // category global route
    Route::get('/get-child-category/{id}', 'CategoryController@getChildCategory');

     //subcategory routes
    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/', 'SubcategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SUbcategoryController@store')->name('store.subcategory');
        Route::get('/delete/{id}', 'SubcategoryController@delete')->name('delete.subcategory');
        Route::get('/edit/{id}', 'SubcategoryController@edit');
        Route::post('/update', 'SubcategoryController@update')->name('update.subcategory');
    });

     //childcategory routes
     Route::group(['prefix'=>'childcategory'], function(){
        Route::get('/', 'ChildcategoryController@index')->name('childcategory.index');
        Route::post('/store', 'ChildcategoryController@store')->name('store.childcategory');
        Route::get('/delete/{id}', 'ChildcategoryController@delete')->name('delete.childcategory');
        Route::get('/edit/{id}', 'ChildcategoryController@edit');
        Route::post('/update', 'ChildcategoryController@update')->name('update.childcategory');
    });

    //product routes
     Route::group(['prefix'=>'product'], function(){
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::get('/show', 'ProductController@show')->name('product.show');
        Route::get('/view/{id}', 'ProductController@view');
        //status enable/disable route
        Route::get('status/{id}', 'ProductController@status');
        Route::get('featured/{id}', 'ProductController@featured');
        Route::get('/delete/{id}', 'ProductController@delete');

        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('/update', 'ProductController@update')->name('product.update');
    });
    //brand routes
     Route::group(['prefix'=>'brand'], function(){
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::post('/store', 'BrandController@store')->name('store.brand');
        Route::get('/delete/{id}', 'BrandController@delete')->name('delete.brand');
        Route::get('/edit/{id}', 'BrandController@edit');
        Route::post('/update', 'BrandController@update')->name('update.brand');
    });

     //warehouse routes
     Route::group(['prefix'=>'warehouse'], function(){
        Route::get('/', 'WarehouseController@index')->name('warehouse.index');
        Route::post('/store', 'WarehouseController@store')->name('warehouse.store');
        Route::get('/delete/{id}', 'WarehouseController@delete')->name('warehouse.delete');
        Route::get('/edit/{id}', 'WarehouseController@edit');
        Route::post('/update', 'WarehouseController@update')->name('warehouse.update');
    });

    //Coupon routes
    Route::group(['prefix'=>'coupon'], function(){
        Route::get('/', 'CouponController@index')->name('coupon.index');
        Route::post('/store', 'CouponController@store')->name('coupon.store');
        Route::get('/delete/{id}', 'CouponController@delete')->name('coupon.delete');
        Route::get('/edit/{id}', 'CouponController@edit');
        Route::post('/update', 'CouponController@update')->name('coupon.update');
    });

      //Pickup routes
      Route::group(['prefix'=>'pickup'], function(){
        Route::get('/', 'PickupController@index')->name('pickup.index');
        Route::post('/store', 'PickupController@store')->name('pickup.store');
        Route::get('/delete/{id}', 'PickupController@delete')->name('pickup.delete');
        Route::get('/edit/{id}', 'PickupController@edit');
        Route::post('/update', 'PickupController@update')->name('pickup.update');
    });


     //setting
     Route::group(['prefix'=>'settings'], function(){
         //seo routes
     Route::group(['prefix'=>'seo'], function(){
        Route::get('/', 'SettingsController@seo')->name('seo.setting');
        Route::post('/update/{id}', 'SettingsController@seoUpdate')->name('seo.update');

    });
      //smtp routes
      Route::group(['prefix'=>'smtp'], function(){
        Route::get('/', 'SettingsController@smtp')->name('smtp.setting');
        Route::post('/update/{id}', 'SettingsController@smtpUpdate')->name('smtp.update');

    });

    //website routes
      Route::group(['prefix'=>'website'], function(){
        Route::get('/', 'SettingsController@website')->name('website.setting');
        Route::post('/update/{id}', 'SettingsController@wedsiteUpdate')->name('website.update');

    });

      //page routes
      Route::group(['prefix'=>'page'], function(){
        Route::get('/', 'PageController@index')->name('page.index');
        Route::post('/store', 'PageController@store')->name('page.store');
        Route::get('/delete/{id}', 'PageController@delete')->name('page.delete');
        Route::get('/edit/{id}', 'PageController@edit');
        Route::post('/update', 'PageController@update')->name('page.update');

    });




    });
});

