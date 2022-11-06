<?php

use App\Http\Controllers\Backend\OverwatchController;
use App\Http\Controllers\Backend\UsersController;
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

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::redirect('/', '/admin/overwatch');
    Route::get('/overwatch', [OverwatchController::class, 'index'])->name('overwatch');

    Route::any('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/users/add', [UsersController::class, 'create'])->name('add-users');
    Route::post('/users/store', [UsersController::class, 'store'])->name('store-users');
    Route::get('/users/edit/{uid}', [UsersController::class, 'edit'])->name('edit-users');
    Route::post('/users/update/{uid}', [UsersController::class, 'update'])->name('update-users');
    Route::get('/users/destroy/{uid}', [UsersController::class, 'destroy'])->name('destroy-users');

    Route::any('/orders', [UsersController::class, 'index'])->name('users');
    Route::get('/orders/add', 'Backend\UsersController@create')->name('add-users');
    Route::post('/orders/store', 'Backend\UsersController@store')->name('store-users');
    Route::get('/orders/edit/{uid}', 'Backend\UsersController@edit')->name('edit-users');
    Route::post('/orders/update/{uid}', 'Backend\UsersController@update')->name('update-users');
    Route::get('/orders/destroy/{uid}', 'Backend\UsersController@destroy')->name('destroy-users');

    Route::resource('profile', 'Backend\ProfileController')->only('index', 'update');
});

Route::get('/', 'Frontend\MarketController@index')->name('market');
Route::get('/market/{mid}', [App\Http\Controllers\Frontend\MarketController::class, 'show']);
