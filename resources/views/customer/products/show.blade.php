\<x-app-layout>

    <h1 class="text-2xl font-semibold mb-4">
        {{ $product->name }}
    </h1>

    <p class="mb-2">
        Price: ₹{{ $product->price }}
    </p>

    @if($product->requires_prescription)
        <p class="text-red-600 font-semibold">
            Prescription required
        </p>
    @endif

    <a href="{{ route('products.index') }}"
       class="inline-block mt-6 text-blue-600">
        ← Back to products
    </a>

</x-app-layout>
