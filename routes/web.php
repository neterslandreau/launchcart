<?php

use Illuminate\Support\Facades\Route;

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
    return view('front');
})->name('front');

Route::get('/contacts', 'ContactsController@index')->name('contacts');
Route::get('/contacts/create', 'ContactsController@create')->name('create');
Route::get('/contacts/{id}/edit', 'ContactsController@edit');
Route::get('/contacts/{id}/delete', 'ContactsController@destroy');
Route::get('/contacts/{id}', 'ContactsController@show')->name('view');
Route::post('/contacts/{id}/edit', 'ContactsController@edit');
Route::post('/contacts', 'ContactsController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
