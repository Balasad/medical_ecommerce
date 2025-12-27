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
    public function show()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        return view('customer.checkout.index', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        // 🔒 Prescription enforcement
        foreach ($cart as $item) {
            if ($item['requires_prescription'] && !$request->hasFile('prescription')) {
                return back()->withErrors('Prescription required for some items.');
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'placed',
            'total_amount' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        ]);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'vendor_id' => $product->vendor_id,
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully');
    }
}
