<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaymentMethodsController;
use App\Http\Controllers\Admin\CurrenciesController;

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
Route::middleware('is_admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [HomeController::class, 'adminHome'])->name('admin.home');
        Route::get('users', [HomeController::class, 'Users'])->name('admin.users');
        Route::get('payment-methods', [HomeController::class, 'PaymentMethods'])->name('admin.payment_methods');
        Route::get('currencies', [HomeController::class, 'Currencies'])->name('admin.currencies');
        Route::prefix('dashboard')->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('search', [UsersController::class, 'Search'])->name('admin.dashboard.users.search');
                Route::post('block', [UsersController::class, 'Block'])->name('admin.dashboard.users.block');
            });
            Route::prefix('payment-methods')->group(function () {
                Route::get('search', [PaymentMethodsController::class, 'Search'])->name('admin.dashboard.payment_methods.search');
                Route::post('create', [PaymentMethodsController::class, 'Create'])->name('admin.dashboard.payment_methods.create');
                Route::post('currencies', [PaymentMethodsController::class, 'Currencies'])->name('admin.dashboard.payment_methods.currencies');
            });
            Route::prefix('currencies')->group(function () {
                Route::get('search', [CurrenciesController::class, 'Search'])->name('admin.dashboard.currencies.search');
                Route::post('create', [CurrenciesController::class, 'Create'])->name('admin.dashboard.currencies.create');
            });
        });
    });
});
Route::middleware('is_user')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
});
