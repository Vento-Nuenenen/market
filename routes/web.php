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

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::redirect('/', '/admin/overwatch');
    Route::get('/overwatch', [App\Http\Controllers\Backend\OverwatchController::class, 'index'])->name('overwatch');
});

Route::get('/', 'Frontend\MarketController@index')->name('market');
Route::get('/market/{mid}', [App\Http\Controllers\Frontend\MarketController::class, 'show']);
