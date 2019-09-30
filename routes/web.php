<?php

Route::get('/', 'PlansController@index')->name('plans');
Route::get('/cycles', 'CyclesController@index')->name('cycles');
Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/sub-categories', 'SubCategoriesController@index')->name('sub-categories');
Route::get('/subdivisions', 'SubdivisionsController@index')->name('subdivisions');
Route::get('/departments', 'DepartmentsController@index')->name('departments');
Route::get('/subjects', 'SubjectsController@index')->name('subjects');

// Плани
Route::get('plan', 'PlansController@getPlans');
Route::post('plan', 'PlansController@postPlans');
Route::post('plan/{id}/', 'PlansController@putPlans');
Route::delete('plan/{id}/', 'PlansController@deletePlans');

Route::get('plan-controls/{id}/', 'PlansController@getPlanControls');

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

// Під категорії
Route::get('sub-category', 'SubCategoriesController@getSubCategories');
Route::post('sub-category', 'SubCategoriesController@postSubCategories');
Route::post('sub-category/{id}/', 'SubCategoriesController@putSubCategories');
Route::delete('sub-category/{id}/', 'SubCategoriesController@deleteSubCategories');

// Факультети
Route::get('subdivision', 'SubdivisionsController@getSubdivisions');
Route::post('subdivision', 'SubdivisionsController@postSubdivisions');
Route::post('subdivision/{id}/', 'SubdivisionsController@putSubdivisions');
Route::delete('subdivision/{id}/', 'SubdivisionsController@deleteSubdivisions');

// Кафедри
Route::get('department', 'DepartmentsController@getDepartments');
Route::get('department/{id}/', 'DepartmentsController@getDepartmentId');
Route::post('department', 'DepartmentsController@postDepartments');
Route::post('department/{id}/', 'DepartmentsController@putDepartments');
Route::delete('department/{id}/', 'DepartmentsController@deleteDepartments');

// Предмети
Route::get('subject', 'SubjectsController@getSubjects');
Route::post('subject', 'SubjectsController@postSubjects');
Route::post('subject/{id}/', 'SubjectsController@putSubjects');
Route::delete('subject/{id}/', 'SubjectsController@deleteSubjects');

Auth::routes();