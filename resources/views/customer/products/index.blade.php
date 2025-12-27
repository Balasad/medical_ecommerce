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
    
<button
    type="button"
    class="add-to-cart-btn mt-2 bg-green-600 text-white px-4 py-2 rounded"
    data-product-id="{{ $product->id }}"
>
    Add to Cart
</button>
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
 <script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const productId = this.dataset.productId;

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                alert('Added to cart');
            });
        });
    });

});
</script>


@endforeach
