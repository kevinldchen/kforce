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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('supplier', 'SupplierController@store');
Route::get('supplier/index', 'SupplierController@index');
Route::get('supplier/create', 'SupplierController@create');
Route::get('supplier/{id}', 'SupplierController@show'); //must go last. wildcard will eat other routes

Route::post('item', 'ItemController@store');
Route::get('item/index', 'ItemController@index');
Route::get('item/create', 'ItemController@create');
Route::get('item/{id}', 'ItemController@show'); //must go last. wildcard will eat other routes

Route::post('project', 'ProjectController@store');
Route::get('project/index', 'ProjectController@index');
Route::get('project/create', 'ProjectController@create');
Route::get('project/{id}', 'ProjectController@show'); //must go last. wildcard will eat other routes

Route::post('contract', 'ContractController@store');
Route::get('contract/index', 'ContractController@index');
Route::get('contract/create', 'ContractController@create');
Route::get('contract/{id}', 'ContractController@show'); //must go last. wildcard will eat other routes

Route::post('order', 'OrderController@store');
Route::get('order/index', 'OrderController@index');
Route::get('order/create', 'OrderController@create');
Route::get('order/{id}', 'OrderController@show'); //must go last. wildcard will eat other routes
