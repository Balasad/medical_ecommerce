<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);

            $table->boolean('requires_prescription')->default(false);

            // Vendor submits → Admin controls visibility
            $table->enum('vendor_status', ['draft', 'submitted'])
                  ->default('draft');

            $table->enum('admin_status', ['unprocessed', 'processed', 'rejected'])
                  ->default('unprocessed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
