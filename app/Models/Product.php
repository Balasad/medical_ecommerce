<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'sku',
        'price',
        'stock',
        'requires_prescription',
        'vendor_status',
        'admin_status',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
