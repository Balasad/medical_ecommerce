<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Vendor;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $vendor = Vendor::first();

        if (!$vendor) {
            return;
        }

        Product::create([
            'vendor_id' => $vendor->id,
            'sku' => 'PARA-500-' . Str::upper(Str::random(6)),
            'name' => 'Paracetamol 500mg',
            'price' => 25,
            'requires_prescription' => false,
            'admin_status' => 'pending',
        ]);

        Product::create([
            'vendor_id' => $vendor->id,
            'sku' => 'AMOX-250-' . Str::upper(Str::random(6)),
            'name' => 'Amoxicillin 250mg',
            'price' => 120,
            'requires_prescription' => true,
            'admin_status' => 'pending',
        ]);
    }
}
