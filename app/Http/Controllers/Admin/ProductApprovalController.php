<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApprovalController extends Controller
{
    public function index()
    {
        $products = Product::where('vendor_status', 'submitted')
            ->where('admin_status', 'unprocessed')
            ->get();

        return view('admin.products.pending', compact('products'));
    }

    public function process(Product $product)
    {
        $product->update([
            'admin_status' => 'processed',
        ]);

        return redirect()->back()->with('success', 'Product approved');
    }

    public function reject(Product $product)
    {
        $product->update([
            'admin_status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Product rejected');
    }
}
