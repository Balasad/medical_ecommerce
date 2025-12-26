<x-app-layout>

    <div class="bg-white rounded-lg shadow p-8 max-w-4xl mx-auto">

        <div class="grid md:grid-cols-2 gap-8">

            <!-- LEFT: PRODUCT INFO -->
            <div>
                <h1 class="text-3xl font-bold mb-3">
                    {{ $product->name }}
                </h1>

                <p class="text-2xl font-semibold text-brand mb-4">
                    ₹{{ $product->price }}
                </p>

                @if($product->requires_prescription)
                    <div class="bg-red-50 text-red-700 px-4 py-3 rounded mb-4">
                        ⚠ Prescription Required for this medicine
                    </div>
                @else
                    <div class="bg-green-50 text-green-700 px-4 py-3 rounded mb-4">
                        ✔ No prescription required
                    </div>
                @endif

                <p class="text-gray-600 mb-6">
                    {{ $product->description ?? 'No description provided.' }}
                </p>

                <!-- CTA -->
                @auth
                    <form method="POST" action="{{ route('orders.store') }}" class="flex gap-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number"
                               name="quantity"
                               value="1"
                               min="1"
                               class="border rounded px-3 py-2 w-24">

                        <button class="bg-brand text-white px-6 py-3 rounded font-semibold">
                            Order Now
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-block bg-brand text-white px-6 py-3 rounded font-semibold">
                        Login to Order
                    </a>
                @endauth
            </div>

            <!-- RIGHT: TRUST INFO -->
            <div class="bg-muted rounded-lg p-6">
                <h3 class="font-semibold mb-4">Medicine Information</h3>

                <ul class="text-sm text-gray-700 space-y-2">
                    <li>✔ Verified by Admin</li>
                    <li>✔ Sold by Trusted Vendor</li>
                    <li>✔ Secure Prescription Handling</li>
                </ul>

                <div class="mt-6 border-t pt-4 text-sm">
                    <p class="font-semibold">Vendor</p>
                    <p class="text-gray-600">
                        {{ $product->vendor->name ?? 'Verified Vendor' }}
                    </p>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
