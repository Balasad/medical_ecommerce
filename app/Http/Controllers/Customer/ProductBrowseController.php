<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductBrowseController extends Controller
{
    public function index()
    {
        $products = Product::where('vendor_status', 'submitted')
            ->where('admin_status', 'processed')
            ->get();

        return view('customer.products.index', compact('products'));
    }
}
