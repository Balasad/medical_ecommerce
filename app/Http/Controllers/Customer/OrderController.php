<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Prescription;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
    return redirect()->route('login')
        ->with('error', 'Please login to place an order');
}

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Product must be admin-approved
        if ($product->admin_status !== 'processed') {
            abort(403);
        }

        // Prescription check
        if ($product->requires_prescription) {
            $prescription = Prescription::where('user_id', Auth::id())
                ->where('status', 'approved')
                ->latest()
                ->first();

            if (!$prescription) {
                return redirect()->back()
                    ->with('error', 'Approved prescription required');
            }
        }

        $vendor = Vendor::findOrFail($product->vendor_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'vendor_id' => $vendor->id,
            'prescription_id' => $product->requires_prescription ? $prescription->id : null,
            'total_amount' => $product->price * $request->quantity,
            'status' => 'processing',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
        ]);

        return redirect()->back()->with('success', 'Order placed successfully');
    }
}
