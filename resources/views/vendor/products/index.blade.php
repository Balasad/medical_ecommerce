<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">
        My Products
    </h1>

    @if($products->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            <p>No products created yet.</p>
        </div>
    @else
        @foreach($products as $product)
            <div class="border p-4 mb-4 rounded">
                <h2 class="font-semibold">
                    {{ $product->name }}
                </h2>

                <p>SKU: {{ $product->sku }}</p>
                <p>Price: ₹{{ $product->price }}</p>

                <p>
                    Vendor Status:
                    <strong>{{ $product->vendor_status }}</strong>
                </p>

                <p>
                    Admin Status:
                    <strong>{{ $product->admin_status }}</strong>
                </p>

                @if($product->vendor_status === 'draft')
                    <form method="POST"
                          action="{{ route('vendor.products.submit', $product) }}">
                        @csrf
                        <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">
                            Submit for Approval
                        </button>
                    </form>
                @elseif($product->admin_status === 'processed')
                    <span class="text-green-600 font-semibold">
                        ✔ Approved
                    </span>
                @else
                    <span class="text-yellow-600">
                        Waiting for admin approval
                    </span>
                @endif
            </div>
        @endforeach
    @endif
</x-app-layout>
