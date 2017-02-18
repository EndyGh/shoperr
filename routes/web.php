<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'ProductController@index')->name('home'); // Личный кабинет


Route::get('/', 'ProductController@index')->name('index');

Route::get('/checkout','CheckoutController@index')
    ->name('checkout.index')->middleware('auth');

Route::post('checkout/store','CheckoutController@store')
    ->name('checkout.store')->middleware('auth');

Route::get('/product/{name}','ProductController@show')
    ->name('product.single');

Route::post('/product/recently','ProductController@recentlyViewed')
    ->name('product.recently');

// customer,manager,admin can post review
Route::post('/product/review/{id}','ProductController@storeReviewForProduct')
    ->middleware('can:customer-access')
    ->name('product.review.store');

Route::get('catalog/{path}', 'CatalogController@show')
    ->where('path', '[a-zA-Z0-9/_-]+')->name('catalog.categories');

// where category - category id
Route::post('catalog/filter/{category}','CatalogController@filter')
    ->where('category','[0-9]+')
    ->middleware('throttle:7,1') // 7 attempts per minute
    ->name('catalog.filter');

Route::get('/page/{path}','HomeController@showPage')
    ->name('pages.show');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('cart', 'CartController');
    Route::delete('emptyCart', 'CartController@emptyCart')->name('emptyCart');
    Route::post('switchToWishlist/{id}', 'CartController@switchToWishlist')->name('switchToWishlist');
    Route::resource('wishlist', 'WishlistController');
    Route::delete('emptyWishlist', 'WishlistController@emptyWishlist')->name('emptyWithList');
    Route::post('switchToCart/{id}', 'WishlistController@switchToCart')->name('switchToCart');
});

Route::group(['namespace' => 'Admin'], function()
{
    // manager and admin have access,but not customer
   Route::group(['prefix'=>'admin','middleware'=>'can:manager-access'],function()
   {
       Route::get('/', function () {
           return view('admin.index')->withPageHeader('');
       })->name('admin.index');

       // get export/import view
       Route::get('products/export',"ProductController@export")->name('product.export');

       Route::get('products/downloadExcel/{type}', 'ProductController@downloadExcel')
       ->name('product.downLoadExcel');
       Route::post('products/importExcel', 'ProductController@importExcel')->name('product.importExcel');

       Route::get('/currency','ProductController@putCurrency')->name('product.update.currency');
       Route::get('products',"ProductController@index")->name('product.index');
       Route::post('products/create',"ProductController@create")->name('product.create');

       Route::get('categories',"CategoryController@index")->name('category.index');
       Route::post('categories/create',"CategoryController@create")->name('category.create');

       Route::get('brands',"BrandController@index")->name('brand.index');
       Route::post('brands/create',"BrandController@create")->name('brand.create');

       Route::get('pages',"PageController@index")->name('page.index');
       Route::post('pages/create',"PageController@create")->name('page.create');

       Route::get('slider',"SliderController@index")->name('slider.index');
       Route::get('slider/edit',"SliderController@edit")->name('slider.edit');
       Route::post('slider/update/{id}',"SliderController@update")->name('slider.update');
       Route::post('slider/delete/{id}',"SliderController@delete")->name('slider.delete');
       Route::post('slider',"SliderController@create")->name('slider.create');

       Route::get('image',"ImageController@index")->name('image.index');
       Route::post('image/create',"ImageController@create")->name('image.create');
       Route::get('image/edit',"ImageController@edit")->name('image.edit');
       Route::get('image/delete/{id}',"ImageController@delete")->name('image.delete');

       Route::get('products/edit',"ProductController@edit")->name('product.edit');
       Route::get('products/update/{id}',"ProductController@update")->name('product.update');
       Route::post('products/update/{id}',"ProductController@postUpdate")->name('product.post-update');
       Route::post('products/delete/{id}',"ProductController@delete")->name('product.delete');

       Route::get('categories/edit',"CategoryController@edit")->name('category.edit');
       Route::get('categories/update/{id}',"CategoryController@update")->name('category.update');
       Route::post('categories/update/{id}',"CategoryController@postUpdate")->name('category.post-update');
       Route::post('categories/delete/{id}',"CategoryController@delete")->name('category.delete');

       Route::get('brands/edit',"BrandController@edit")->name('brand.edit');
       Route::get('brands/update/{id}',"BrandController@update")->name('brand.update');
       Route::post('brands/update/{id}',"BrandController@postUpdate")->name('brand.post-update');
       Route::post('brands/delete/{id}',"BrandController@delete")->name('brand.delete');

       Route::get('pages/edit',"PageController@edit")->name('page.edit');
       Route::get('pages/update/{id}',"PageController@update")->name('page.update');
       Route::post('pages/update/{id}',"PageController@postUpdate")->name('page.post-update');
       Route::post('pages/delete/{id}',"PageController@delete")->name('page.delete');

       Route::post('property/store',"ProductController@propertyStore")->name('property.store');

   });
});