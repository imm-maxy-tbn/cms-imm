<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pages/create', 'PageController@create')->name('pages.create');
Route::post('/pages', 'PageController@store')->name('pages.store');
Route::get('/pages', 'PageController@index')->name('pages.index');
Route::get('pages/{id}/edit', 'PageController@edit')->name('pages.edit');
Route::delete('pages/{id}', 'PageController@destroy')->name('pages.destroy');
Route::put('pages/{id}', 'PageController@update')->name('pages.update');
