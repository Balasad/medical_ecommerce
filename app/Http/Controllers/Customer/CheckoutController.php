<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // 🔐 Ensure login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty');
        }

        return view('customer.checkout.index', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty');
        }

        // 🔒 Prescription enforcement (re-check from DB)
        foreach ($cart as $productId => $item) {
            $product = Product::findOrFail($productId);

            if ($product->requires_prescription) {
                return back()->with(
                    'error',
                    'Prescription-required products need approval before checkout'
                );
            }
        }

        // ✅ Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'placed',
            'total_amount' => collect($cart)->sum(
                fn ($item) => $item['price'] * $item['quantity']
            ),
        ]);

        // ✅ Order items
        foreach ($cart as $productId => $item) {
            $product = Product::findOrFail($productId);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'vendor_id' => $product->vendor_id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully');
    }
}
