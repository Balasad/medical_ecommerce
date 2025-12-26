@props(['product'])

<div class="bg-white rounded-lg p-4 shadow hover:shadow-md transition">

    <h3 class="font-semibold text-lg">
        <a href="{{ route('products.show', $product->id) }}"
           class="hover:underline">
            {{ $product->name }}
        </a>
    </h3>

    <p class="text-gray-600 mt-1">₹{{ $product->price }}</p>

    @if($product->requires_prescription)
        <span class="text-xs text-red-500 mt-2 inline-block">
            Prescription Required
        </span>
    @endif

    <div class="mt-4">
        @auth
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="w-full bg-brand text-white py-2 rounded">
                    Order
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
               class="block text-center border py-2 rounded">
                Login to Order
            </a>
        @endauth
    </div>

</div>
