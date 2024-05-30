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
Route::get('/pages/{id}/view', 'PageController@view')->name('pages.view');


use App\Http\Controllers\TagController;

Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');
Route::get('/tags/{id}/view', [TagController::class, 'view'])->name('tags.view');


use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}/view', [UserController::class, 'view'])->name('users.view');


use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}/view', [CategoryController::class, 'view'])->name('categories.view');


use App\Http\Controllers\CompanyController;

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{id}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');
Route::get('/companies/{id}/view', [CompanyController::class, 'view'])->name('companies.view');


use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}/view', [PostController::class, 'view'])->name('posts.view');
Route::post('/posts/image/upload', [PostController::class, 'uploadImage'])->name('posts.uploadImage');

use App\Http\Controllers\SdgController;

Route::get('/sdgs', [SdgController::class, 'index'])->name('sdgs.index');
Route::get('/sdgs/create', [SdgController::class, 'create'])->name('sdgs.create');
Route::post('/sdgs/store', [SdgController::class, 'store'])->name('sdgs.store');
Route::get('/sdgs/{id}/edit', [SdgController::class, 'edit'])->name('sdgs.edit');
Route::put('/sdgs/{id}', [SdgController::class, 'update'])->name('sdgs.update');
Route::delete('/sdgs/{id}', [SdgController::class, 'destroy'])->name('sdgs.destroy');
Route::get('/sdgs/{id}/view', [SdgController::class, 'view'])->name('sdgs.view');

use App\Http\Controllers\IndicatorController;

Route::get('/indicators', [IndicatorController::class, 'index'])->name('indicators.index');
Route::get('/indicators/create', [IndicatorController::class, 'create'])->name('indicators.create');
Route::post('/indicators/store', [IndicatorController::class, 'store'])->name('indicators.store');
Route::get('/indicators/{id}/edit', [IndicatorController::class, 'edit'])->name('indicators.edit');
Route::put('/indicators/{id}', [IndicatorController::class, 'update'])->name('indicators.update');
Route::delete('/indicators/{id}', [IndicatorController::class, 'destroy'])->name('indicators.destroy');
Route::get('/indicators/{id}/view', [IndicatorController::class, 'view'])->name('indicators.view');

use App\Http\Controllers\MetricController;

Route::get('/metrics', [MetricController::class, 'index'])->name('metrics.index');
Route::get('/metrics/create', [MetricController::class, 'create'])->name('metrics.create');
Route::post('/metrics/store', [MetricController::class, 'store'])->name('metrics.store');
Route::get('/metrics/{id}/edit', [MetricController::class, 'edit'])->name('metrics.edit');
Route::put('/metrics/{id}', [MetricController::class, 'update'])->name('metrics.update');
Route::delete('/metrics/{id}', [MetricController::class, 'destroy'])->name('metrics.destroy');
Route::get('/metrics/{id}/view', [MetricController::class, 'view'])->name('metrics.view');

use App\Http\Controllers\ProjectController;

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('/projects/{id}/view', [ProjectController::class, 'view'])->name('projects.view');

