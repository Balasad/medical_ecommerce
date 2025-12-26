<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Admin\ProductApprovalController;
use App\Http\Controllers\Customer\ProductBrowseController;
use App\Http\Controllers\Customer\PrescriptionController;
use App\Http\Controllers\Admin\PrescriptionApprovalController;
use App\Http\Controllers\Customer\OrderHistoryController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Customer\OrderController;




Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('pages.home');
});
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');

    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->group(function () {

    Route::get('/dashboard', function () {
        return 'Vendor Dashboard';
    })->name('vendor.dashboard');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('vendor.products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('vendor.products.store');

    Route::post('/products/{product}/submit', [ProductController::class, 'submit'])
        ->name('vendor.products.submit');

    });


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/products/pending', [ProductApprovalController::class, 'index'])
        ->name('admin.products.pending');

    Route::post('/products/{product}/process', [ProductApprovalController::class, 'process'])
        ->name('admin.products.process');

    Route::post('/products/{product}/reject', [ProductApprovalController::class, 'reject'])
        ->name('admin.products.reject');

});
Route::get('/products', [ProductBrowseController::class, 'index'])
    ->name('products.index');
   
Route::middleware(['auth'])->group(function () {

    Route::get('/prescriptions/upload', [PrescriptionController::class, 'create'])
        ->name('prescriptions.create');

    Route::post('/prescriptions', [PrescriptionController::class, 'store'])
        ->name('prescriptions.store');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/prescriptions', [PrescriptionApprovalController::class, 'index'])
        ->name('admin.prescriptions.index');

    Route::post('/prescriptions/{prescription}/approve', [PrescriptionApprovalController::class, 'approve'])
        ->name('admin.prescriptions.approve');

    Route::post('/prescriptions/{prescription}/reject', [PrescriptionApprovalController::class, 'reject'])
        ->name('admin.prescriptions.reject');

});


Route::middleware(['auth'])->group(function () {

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');

});

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->group(function () {

    Route::get('/orders', [VendorOrderController::class, 'index'])
        ->name('vendor.orders.index');

    Route::post('/orders/{order}/status', [VendorOrderController::class, 'updateStatus'])
        ->name('vendor.orders.updateStatus');

});


Route::middleware(['auth'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderHistoryController::class, 'index'])
        ->name('orders.index');
});




});

require __DIR__.'/auth.php';