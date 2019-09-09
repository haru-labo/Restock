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

Route::get('/', 'ItemController@index');
Route::get('item/create', 'ItemController@create');
Route::post('item/store', 'ItemController@store');
Route::get('item/{id}/edit', 'ItemController@edit');
Route::post('item/{id}/edit', 'ItemController@update');
Route::delete('item/{id}/destroy', 'ItemController@destroy');
Route::post('item/{id}/open', 'ItemController@open');
