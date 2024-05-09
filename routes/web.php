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

use App\Http\Controllers\TagController;

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');

use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);
