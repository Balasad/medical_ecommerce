<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductBrowseController extends Controller
{
  public function index()
{
    $products = Product::where('admin_status', 'approved')
        ->get();

    return view('customer.products.index', compact('products'));
}
public function show(Product $product)
{
    // safety: only show approved products
    if ($product->admin_status !== 'approved') {
        abort(404);
    }

    return view('customer.products.show', compact('product'));
}


}
