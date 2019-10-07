<?php

// Плани
Route::get('plan', 'PlansController@getPlans');
Route::post('plan', 'PlansController@postPlans');
Route::post('plan/{id}/', 'PlansController@putPlans');
Route::delete('plan/{id}/', 'PlansController@deletePlans');
Route::get('plan/{id}/', 'PlansController@getPlanId');

Route::get('plan-controls/{id}/', 'PlansController@getPlanControls');
Route::post('plan-controls', 'PlansController@postPlanControls');
Route::post('plan-items', 'PlansController@postPlanItems');
Route::get('plan-items/{id}/', 'PlansController@getPlanItems');
Route::delete('plan-items/{id}/', 'PlansController@deletePlanItems');
Route::post('plan-items/update-learning-plan/{id}/', 'PlansController@updateLearningPlanItems');
Route::post('distribution-of-hours', 'PlansController@postHoursItems');

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

Route::get('/{any}', 'HomeController@index')->where('any', '.*');

Auth::routes();