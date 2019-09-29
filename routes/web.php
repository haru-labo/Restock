<?php

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\ItemController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'item'], function() {
    Route::get('index', 'ItemController@index')->name('item.index');
    Route::get('create', 'ItemController@create')->name('item.create');
    Route::post('store', 'ItemController@store')->name('item.store');
    Route::get('{id}/edit', 'ItemController@edit')->name('item.edit');
    Route::post('{id}/edit', 'ItemController@update')->name('item.update');
    Route::delete('{id}/destroy', 'ItemController@destroy')->name('item.destroy');
    Route::post('{id}/open', 'ItemController@open')->name('item.open');
    Route::post('{id}/restock', 'ItemController@restock')->name('item.restock');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
