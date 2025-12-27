<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Prescription;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingProducts = Product::where('admin_status', 'pending')->count();

        $pendingPrescriptions = Prescription::where('status', 'pending')->count();

        $totalOrders = Order::count();

        return view('admin.dashboard', compact(
            'pendingProducts',
            'pendingPrescriptions',
            'totalOrders'
        ));
    }
}
