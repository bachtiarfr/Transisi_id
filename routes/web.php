<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/employee', 'EmployeesController@index')->name('employee-controller');

Route::group(['prefix' => 'company'], function () {
    Route::get('/', 'CompaniesController@index')->name('company-controller');
    Route::post('/save-data', 'CompaniesController@store')->name('save-company-data');
    Route::get('/delete/{id}', 'CompaniesController@destroy')->name('delete-company-data');
    Route::get('/edit/{id}', 'CompaniesController@edit')->name('edit-company-data');
    Route::post('/update-data/{id}', 'CompaniesController@update')->name('update-company-data');
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('/', 'EmployeesController@index')->name('employee-controller');
    Route::post('/save-data', 'EmployeesController@store')->name('save-employee-data');
    Route::get('/delete/{id}', 'EmployeesController@destroy')->name('delete-employee-data');
    Route::get('/edit/{id}', 'EmployeesController@edit')->name('edit-employee-data');
    Route::post('/update-data/{id}', 'EmployeesController@update')->name('update-employee-data');
});


