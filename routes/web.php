<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->middleware('ajax-request')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group(['prefix' => 'admin','middleware' => ['web', 'auth']], function () {

    Route::get('log-viewer', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Data Master
    Route::middleware('ajax-request')->controller(MasterController::class)->group(function() {
        Route::get('/data-role', 'list_data_role');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('/reset-password/{id}', 'reset_password')->middleware('ajax-request');
        Route::get('/change-password', 'change_password');
        Route::post('/process-change-password', 'process_change_password')->middleware('ajax-request');
    });

    // User Management
    Route::prefix('user-management')->controller(UserManagementController::class)->group(function() {
        // user
        Route::middleware("can:SubMenu, 'UM1'")->group(function() {
            Route::get('/', 'index');
            Route::get('/datatable', 'datatable_user_management');
            Route::post('/register', 'register')->name('register');
            Route::get('/edit/{id}', 'edit_user');
            Route::get('/delete/{id}', 'delete_user');
        });

        // menu
        Route::group(['prefix' => 'menu', 'middleware' => "can:SubMenu, 'UM2'"], function() {
            Route::get('/', 'menu');
            Route::get('/datatable', 'datatable_menu');
            Route::post('/store', 'store_menu');
            Route::get('/edit/{id}', 'edit_menu');
            Route::get('/delete/{id}', 'delete_menu');
        });

        // role
        Route::group(['prefix' => 'role', 'middleware' => "can:SubMenu, 'UM3'"], function() {
            Route::get('/', 'role');
            Route::get('/datatable', 'datatable_role');
            Route::post('/store', 'store_role');
            Route::get('/edit/{id}', 'edit_role');
            Route::get('/delete/{id}', 'delete_role');
            Route::get('/list-permissions-menu', 'list_permissions_menu')->middleware('ajax-request');
        });
    });

});