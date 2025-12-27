<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Customer (Public + Auth)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Customer\ProductBrowseController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\OrderHistoryController;
use App\Http\Controllers\Customer\PrescriptionController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'show'])
    ->name('checkout.show');

Route::post('/checkout', [CheckoutController::class, 'placeOrder'])
    ->name('checkout.place');


Route::get('/home', function () {
    return redirect()->route('products.index');
})->name('customer.home');


Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::get('/products/{product}', [ProductBrowseController::class, 'show'])
    ->name('products.show');

Route::get('/products', [ProductBrowseController::class, 'index'])
    ->name('products.index');

Route::middleware('auth')->group(function () {

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::get('/orders', [OrderHistoryController::class, 'index'])
        ->name('orders.index');

    Route::get('/prescriptions/upload', [PrescriptionController::class, 'create'])
        ->name('prescriptions.create');

    Route::post('/prescriptions', [PrescriptionController::class, 'store'])
        ->name('prescriptions.store');
});

/*
|--------------------------------------------------------------------------
| Vendor
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Vendor
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;

Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])
            ->name('vendor.dashboard');

        // 🔹 VIEW vendor products (FIXED)
        Route::get('/products', [ProductController::class, 'index'])
            ->name('vendor.products.index');

        // Create product
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('vendor.products.create');

        // Store product
        Route::post('/products', [ProductController::class, 'store'])
            ->name('vendor.products.store');

        // Submit product for admin approval
        Route::post('/products/{product}/submit', [ProductController::class, 'submit'])
            ->name('vendor.products.submit');

        // Vendor orders
        Route::get('/orders', [VendorOrderController::class, 'index'])
            ->name('vendor.orders.index');

        Route::post('/orders/{order}/status', [VendorOrderController::class, 'updateStatus'])
            ->name('vendor.orders.updateStatus');
    });


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductApprovalController;
use App\Http\Controllers\Admin\PrescriptionApprovalController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/products/pending', [ProductApprovalController::class, 'index'])
            ->name('admin.products.pending');

        Route::post('/products/{product}/process', [ProductApprovalController::class, 'process'])
            ->name('admin.products.process');

        Route::post('/products/{product}/reject', [ProductApprovalController::class, 'reject'])
            ->name('admin.products.reject');

        Route::get('/prescriptions', [PrescriptionApprovalController::class, 'index'])
            ->name('admin.prescriptions.index');

        Route::post('/prescriptions/{prescription}/approve', [PrescriptionApprovalController::class, 'approve'])
            ->name('admin.prescriptions.approve');

        Route::post('/prescriptions/{prescription}/reject', [PrescriptionApprovalController::class, 'reject'])
            ->name('admin.prescriptions.reject');
    });

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
