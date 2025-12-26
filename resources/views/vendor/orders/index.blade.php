<h2>My Orders</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if($orders->isEmpty())
    <p>No orders found</p>
@endif

@foreach($orders as $order)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>Order #{{ $order->id }}</strong><br>
        Status: {{ ucfirst($order->status) }}<br>
        Total: ₹{{ $order->total_amount }}<br>

        <form method="POST" action="{{ route('vendor.orders.updateStatus', $order) }}">
            @csrf
            <select name="status">
                <option value="processing" @selected($order->status === 'processing')>Processing</option>
                <option value="completed" @selected($order->status === 'completed')>Completed</option>
                <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
@endforeach
