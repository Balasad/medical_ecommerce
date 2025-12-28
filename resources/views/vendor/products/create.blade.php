<x-app-layout>

    <h1 class="text-2xl font-semibold mb-6">Create Product</h1>

    <form method="POST"
          action="{{ route('vendor.products.store') }}"
          class="space-y-4 bg-white p-6 rounded shadow">

        @csrf

        <!-- Name -->
        <div>
            <label class="block font-medium">Name</label>
            <input type="text"
                   name="name"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <!-- SKU -->
        <div>
            <label class="block font-medium">SKU</label>
            <input type="text"
                   name="sku"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <!-- Price -->
        <div>
            <label class="block font-medium">Price</label>
            <input type="number"
                   name="price"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <!-- Stock -->
        <div>
            <label class="block font-medium">Stock</label>
            <input type="number"
                   name="stock"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        <!-- Prescription -->
        <div class="flex items-center gap-2">
            <input type="checkbox"
                   name="requires_prescription"
                   value="1">
            <span>Requires Prescription</span>
        </div>

        <!-- ✅ SUBMIT BUTTON (THIS WAS MISSING) -->
        <div>
            <button type="submit"
        class="bg-blue-600 text-black px-6 py-2 rounded">
    Save Product
</button>

        </div>

    </form>

</x-app-layout>
