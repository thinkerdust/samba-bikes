<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\MasterManagementController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestController;

Route::get('/', [LandingController::class, 'index'])->middleware('counter-statistik')->name('/');

// get harga
Route::get('/get-harga', [LandingController::class, 'get_harga'])->name('get-harga');
// register-peserta
Route::post('/register-peserta', [LandingController::class, 'register_peserta'])->name('register-peserta');
Route::post('/check-peserta', [LandingController::class, 'check_peserta'])->name('check-peserta');

// test email
Route::get('/test-email-registrasi', [TestController::class, 'testEmailRegistrasi']);
Route::get('/test-email-pembayaran', [TestController::class, 'testEmailPembayaran']);


Route::get('/admin', function() {
    return redirect('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->middleware('redirect-if-authenticated')->name('login');
    Route::post('/authenticate', 'authenticate')->middleware('ajax-request')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group(['prefix' => 'admin','middleware' => ['web', 'auth']], function () {

    Route::get('log-viewer', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/data', 'data_dashboard');
    });

    //Data Master
    Route::middleware('ajax-request')->controller(MasterController::class)->group(function() {
        Route::get('/data-role', 'list_data_role');
        Route::get('/data-size-chart', 'list_data_size_chart');
        Route::get('/data-bank', 'list_data_bank');
        Route::get('/data-event', 'list_data_event');
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

    // Master Management
    Route::prefix('master-management')->controller(MasterManagementController::class)->group(function() {
        // size chart
        Route::group(['prefix' => 'size-chart', 'middleware' => "can:SubMenu, 'MS1'"], function() {
            Route::get('/', 'size_chart');
            Route::get('/datatable', 'datatable_size_chart');
            Route::post('/store', 'store_size_chart');
            Route::get('/edit/{id}', 'edit_size_chart');
            Route::get('/delete/{id}', 'delete_size_chart');
            Route::get('/activate/{id}', 'activate_size_chart');
            Route::get('/deactivate/{id}', 'deactivate_size_chart');
        });
    });

    // Event
    Route::prefix('event')->middleware("can:Menu, 'EVENT'")->controller(EventController::class)->group(function() {
        Route::get('/', 'index');
        Route::post('/datatable', 'datatable_event');
        Route::get('/form/{id?}', 'form_event');
        Route::post('/store', 'store_event');
        Route::get('/edit/{id}', 'edit_event');
        Route::delete('/delete/{id}', 'delete_event');
        Route::get('/release/{id}', 'release_event');
        
        Route::post('/datatable-schedule', 'datatable_schedule');
        Route::get('/edit-schedule/{id}', 'edit_schedule');
        Route::post('/store-schedule', 'store_schedule');
        Route::delete('/delete-schedule/{id}', 'delete_schedule');
        
        Route::get('/sponsor/list/{id_event}', 'list_sponsor');
        Route::post('/sponsor/store', 'store_sponsor');
        Route::delete('/sponsor/delete/{id}', 'delete_sponsor');

        Route::get('/event-images/list/{id_event}', 'list_event_images');
        Route::post('/event-images/store', 'store_event_images');
        Route::delete('/event-images/delete/{id}', 'delete_event_images');
    });

    // Peserta
    Route::prefix('peserta')->middleware("can:Menu, 'PESERTA'")->controller(PesertaController::class)->group(function() {
        Route::get('/', 'index')->name('peserta');
        Route::post('/datatable', 'datatable_peserta');
        Route::get('/edit/{id}', 'edit_peserta');
        Route::get('/delete/{id}', 'delete_peserta');
        Route::post('/store', 'store_peserta');
    });

    // Order
    Route::prefix('order')->middleware("can:Menu, 'ORDER'")->controller(OrderController::class)->group(function() {
        Route::get('/', 'index')->name('order');
        Route::post('/datatable', 'datatable_order');
        Route::get('/edit', 'edit_order');
        Route::get('/detail', 'detail_order');
        Route::post('/payment', 'payment_order');
        Route::get('/delete', 'delete_order');

        Route::get('/racepack', 'racepack');
        Route::post('/racepack/datatable', 'datatable_racepack');
        Route::post('racepack/store', 'store_racepack');
    });

});