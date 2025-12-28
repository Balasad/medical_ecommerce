<x-app-layout>

    <h2 class="text-2xl font-bold mb-4">Available Medicines</h2>

    @if($products->isEmpty())
        <p>No products available</p>
    @endif

    @foreach($products as $product)
        <div class="border p-4 mb-4 rounded">

            <strong>{{ $product->name }}</strong><br>
            Price: ₹{{ $product->price }}<br>

            @if($product->requires_prescription)
                <span class="text-red-600">Prescription Required</span><br>
            @endif

            @auth
                <button
                    type="button"
                    onclick="addToCart({{ $product->id }})"
                    class="mt-2 bg-green-600 text-black px-4 py-2 rounded">
                    Add to Cart
                </button>
            @else
                <a href="{{ route('login') }}">Login to order</a>
            @endauth

        </div>
    @endforeach

</x-app-layout>
