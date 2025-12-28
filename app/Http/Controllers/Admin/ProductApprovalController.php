<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApprovalController extends Controller
{
   public function index()
{
    $products = Product::where('vendor_status', 'submitted')
        ->where('admin_status', 'pending')
        ->get();

    return view('admin.products.pending', compact('products'));
}


    public function process(Product $product)
{
    $product->update([
        'admin_status' => 'approved'
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Product approved'
    ]);
}

public function reject(Product $product)
{
    $product->update([
        'admin_status' => 'rejected'
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Product rejected'
    ]);
}
}