<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

        $totalOrders = Order::where('vendor_id', $vendor->id)->count();

        $processingOrders = Order::where('vendor_id', $vendor->id)
            ->where('status', 'processing')
            ->count();

        $completedOrders = Order::where('vendor_id', $vendor->id)
            ->where('status', 'completed')
            ->count();

        return view('vendor.dashboard', compact(
            'totalOrders',
            'processingOrders',
            'completedOrders'
        ));
    }
}
