<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

        $orders = Order::where('vendor_id', $vendor->id)
            ->latest()
            ->get();

        return view('vendor.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:processing,completed,cancelled',
        ]);

        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

        // Security check: vendor can update only their orders
        if ($order->vendor_id !== $vendor->id) {
            abort(403);
        }

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated');
    }
}
