<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // List vendor products
    public function index()
    {
        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

        $products = Product::where('vendor_id', $vendor->id)->get();

        return view('vendor.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('vendor.products.create');
    }

    // Store product (draft)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'requires_prescription' => 'nullable|boolean',
        ]);

        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

        Product::create([
            'vendor_id' => $vendor->id,
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'requires_prescription' => $request->requires_prescription ?? false,
            'vendor_status' => 'draft',
            'admin_status' => 'unprocessed',
        ]);

        return redirect()
            ->route('vendor.products.index')
            ->with('success', 'Product saved as draft');
    }

    // Submit product for admin approval
    public function submit(Product $product)
    {
        $vendor = Vendor::where('user_id', Auth::id())->firstOrFail();

        if ($product->vendor_id !== $vendor->id) {
            abort(403);
        }

        $product->update([
            'vendor_status' => 'submitted',
            'admin_status'  => 'pending',
        ]);

        return redirect()
            ->route('vendor.products.index')
            ->with('success', 'Product submitted for admin review');
    }
}
