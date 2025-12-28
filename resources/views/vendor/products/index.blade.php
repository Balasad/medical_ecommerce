<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">My Products</h1>

    @foreach($products as $product)
        <div class="border p-4 mb-4 rounded">
            <h2 class="font-semibold">{{ $product->name }}</h2>
            <p>SKU: {{ $product->sku }}</p>
            <p>Price: ₹{{ $product->price }}</p>

            <p>
                Vendor Status:
                <strong>{{ ucfirst($product->vendor_status) }}</strong>
            </p>

            <p>
                Admin Status:
                <strong>{{ ucfirst($product->admin_status) }}</strong>
            </p>

            @if($product->vendor_status === 'draft')
                <form method="POST"
                      action="{{ route('vendor.products.submit', $product->id) }}">
                    @csrf
                    <button class="mt-2 bg-blue-600 text-black px-4 py-1 rounded">
                        Submit for Approval
                    </button>
                </form>
            @endif
        </div>
    @endforeach
</x-app-layout>
