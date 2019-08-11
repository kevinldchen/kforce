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

Route::middleware('auth')->group(function () {
  Route::post('supplier', 'SupplierController@store');
  Route::get('supplier/index', 'SupplierController@index')->name('supplier.index');
  Route::get('supplier/create', 'SupplierController@create')->name('supplier.create');
  Route::get('supplier/{id}', 'SupplierController@show')->name('supplier.show'); //must go last. wildcard will eat other routes

  Route::post('item', 'ItemController@store');
  Route::get('item/index', 'ItemController@index')->name('item.index');
  Route::get('item/create', 'ItemController@create')->name('item.create');
  Route::get('item/{id}', 'ItemController@show')->name('item.show'); //must go last. wildcard will eat other routes

  Route::post('project', 'ProjectController@store');
  Route::get('project/index', 'ProjectController@index')->name('project.index');
  Route::get('project/create', 'ProjectController@create')->name('project.create');
  Route::get('project/{id}', 'ProjectController@show')->name('project.show'); //must go last. wildcard will eat other routes

  Route::post('contract', 'ContractController@store');
  Route::get('contract/index', 'ContractController@index')->name('contract.index');
  Route::get('contract/create', 'ContractController@create')->name('contract.create');
  Route::get('contract/{id}', 'ContractController@show')->name('contract.show'); //must go last. wildcard will eat other routes

  Route::post('order', 'OrderController@store');
  Route::get('order/index', 'OrderController@index')->name('order.index');
  Route::get('order/create', 'OrderController@create')->name('order.create');
  Route::get('order/{id}/additem', 'OrderController@addItem')-> where('id', '[0-9]+')->name('order.additem');
  Route::post('order/{id}/additem', 'OrderController@createMadeOf')-> where('id', '[0-9]+');
  Route::get('order/{id}', 'OrderController@show')-> where('id', '[0-9]+')->name('order.show'); //must go last. wildcard will eat other routes

  Route::get('report/qtyagg', 'ReportController@orderqty_aggregate')->name('report.qtyagg');
});
