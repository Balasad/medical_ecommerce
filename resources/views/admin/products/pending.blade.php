<h2>Pending Products</h2>

@if($products->isEmpty())
    <p>No pending products</p>
@endif

@foreach($products as $product)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>{{ $product->name }}</strong><br>
        SKU: {{ $product->sku }}<br>
        Price: {{ $product->price }}<br>

        <form method="POST" action="{{ route('admin.products.process', $product) }}" style="display:inline;">
            @csrf
            <button type="submit">Process</button>
        </form>

        <form method="POST" action="{{ route('admin.products.reject', $product) }}" style="display:inline;">
            @csrf
            <button type="submit">Reject</button>
        </form>
    </div>
@endforeach
