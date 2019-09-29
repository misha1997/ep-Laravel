<?php

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/cycles', 'CyclesController@index')->name('cycles');
Route::get('/categories', 'CategoriesController@index')->name('categories');

// Цикли
Route::get('cycle', 'CyclesController@getCycles');
Route::post('cycle', 'CyclesController@postCycles');
Route::post('cycle/{id}/', 'CyclesController@putCycles');
Route::delete('cycle/{id}/', 'CyclesController@deleteCycles');

// Категорії
Route::get('category', 'CategoriesController@getCategories');
Route::post('category', 'CategoriesController@postCategories');
Route::post('category/{id}/', 'CategoriesController@putCategories');
Route::delete('category/{id}/', 'CategoriesController@deleteCategories');