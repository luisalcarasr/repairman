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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::view('/', 'auth.login')->name('index');
});

Route::middleware('auth')->group(function () {
    Route::namespace('Resources')->group(function () {
        Route::resource('area', 'AreasController');
        Route::resource('file', 'FilesController');
        Route::resource('machine', 'MachinesController');
        Route::resource('maintenance', 'MaintenancesController', ['except' => 'show']);
        Route::resource('maintenance-type', 'MaintenanceTypesController');
        Route::resource('user', 'UsersController');
        //complete maintenance
        Route::put('maintenance/{id}/complete', 'MaintenancesController@complete')->name('maintenance.complete');;
    });
    Route::resource('dashboard', 'DashboardController', ['only' => ['show', 'index']]);

});