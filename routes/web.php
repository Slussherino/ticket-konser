<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrdersController;

Route::get('/', [OrdersController::class, 'index'])
    ->name('customer.index');

Route::post('/checkout', [OrdersController::class, 'store'])
    ->name('customer.store');


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', [OrdersController::class, 'adminDashboard'])
        ->name('dashboard');

    Route::get('/admin/dashboard', [OrdersController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::patch('/admin/orders/{id}/status', [OrdersController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');


    Route::resource('admin/events', EventsController::class)->names([
        'index' => 'admin.events.index',
        'create' => 'admin.events.create',
        'store' => 'admin.events.store',
        'show' => 'admin.events.show',
        'edit' => 'admin.events.edit',
        'update' => 'admin.events.update',
        'destroy' => 'admin.events.destroy',
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';