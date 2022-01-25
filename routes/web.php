<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('categories', 'App\Http\Controllers\CategoriesController');
Route::resource('sub_categories', 'App\Http\Controllers\SubCategoriesController');
Route::resource('product', 'App\Http\Controllers\ProductController');
Route::get('get_subcategory', 'App\Http\Controllers\SubCategoriesController@get_subcategory');