<?php

#CMS
Route::middleware(['adminGuard'])->group(function () {
  Route::prefix('cms')->group(function() {
    Route::get('dashboard', 'CmsController@dashboard');
    Route::resource('menu', 'MenuController');
    Route::resource('content', 'ContentController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('brand', 'BrandController');
    Route::resource('users', 'CmsUserController');
    Route::get('posts','PostController@getAllPosts');
    Route::get('orders','CmsController@orders');
    Route::get('stock/update','CmsController@stockUpdate');
    Route::get('posts/{id}','PostController@getDeleteFormPost');
    Route::post('posts/{id}','PostController@deletePost');
  });
});



#User
Route::prefix('user')->group(function() {
  Route::get('signin', 'UsersController@getSignin');
  Route::post('signin', 'UsersController@postSignin');
  Route::get('signup', 'UsersController@getSignup');
  Route::post('signup', 'UsersController@postSignup');
  Route::get('logout', 'UsersController@logout');
  Route::get('profile', 'UsersController@getProfile');
  Route::post('profile', 'UsersController@postProfile');
});

#Shop
Route::prefix('shop')->group(function() {
  Route::get('/', 'ShopController@categories');
  Route::get('add-to-cart', 'ShopController@addToCart');
  Route::get('update-cart', 'ShopController@updateCart');
  Route::get('item-delete', 'ShopController@deleteItem');
  Route::get('clear-cart', 'ShopController@clearCart');
  Route::get('shopping-cart', 'ShopController@checkout');
  Route::get('wish-list', 'ShopController@getWish');
  Route::get('add-to-wishlist', 'ShopController@addWish');
  Route::get('delete-from-wishlist', 'ShopController@deleteFromWish');
  Route::get('clear-whishlist', 'ShopController@clearWish');
  Route::get('order', 'ShopController@order');
  Route::get('{url}', 'ShopController@category');
  Route::get('{curl}/{purl}', 'ShopController@product');
  Route::post('{curl}/{purl}/feedback', 'PostController@postCreatePost');
  Route::get('{curl}/{purl}/feedback/{id}', 'PostController@postDeletePost');
  Route::get('{curl}/{orderBy}/{select}', 'ShopController@select');
});

#Pages
Route::get('/', 'PagesController@home');
Route::any('/getdata','PagesController@searchProduct');
Route::Post('words/means','PagesController@getProducts');
Route::get('{url}', 'PagesController@content');

