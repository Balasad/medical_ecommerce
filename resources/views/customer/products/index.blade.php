<h2>Available Medicines</h2>

@if($products->isEmpty())
    <p>No products available</p>
@endif

@foreach($products as $product)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

        <strong>
            <a href="{{ route('products.show', $product->id) }}"
               style="text-decoration: underline;">
                {{ $product->name }}
            </a>
        </strong><br>

        Price: ₹{{ $product->price }}<br>

        @if($product->requires_prescription)
            <span style="color:red;">Prescription Required</span><br>
        @endif

        @auth
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1">
                <br><br>
                <button type="submit">Order</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login to Order</a>
        @endauth

    </div>
@endforeach
