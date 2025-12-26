<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
{
    $product = \App\Models\Product::with('vendor')->findOrFail($id);

    // Only show admin-approved products
    if ($product->admin_status !== 'processed') {
        abort(404);
    }

    return view('customer.products.show', compact('product'));
}
}

