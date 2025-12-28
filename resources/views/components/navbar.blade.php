<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="font-bold text-lg text-brand">
            Medical E-Commerce
        </a>

        <!-- Links -->
        <div class="flex items-center gap-4">

            {{-- Guest --}}
            @guest
                <a href="{{ route('products.index') }}" class="nav-link">Products</a>
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            @endguest

            {{-- Customer --}}
            @auth
                @role('customer')
                    <a href="{{ route('products.index') }}" class="nav-link">Shop</a>
                    <a href="{{ route('cart.index') }}" class="relative">
    🛒 Cart
    <span id="cart-count"
          class="absolute -top-2 -right-3 bg-red-600 text-white text-xs px-2 rounded-full">
        {{ collect(session('cart', []))->sum('quantity') }}
    </span>
</a>

                    <a href="{{ route('orders.index') }}" class="nav-link">My Orders</a>
                @endrole

                {{-- Vendor --}}
                @role('vendor')
                    <a href="{{ route('vendor.dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('vendor.products.index') }}" class="nav-link">Products</a>
                    <a href="{{ route('vendor.orders.index') }}" class="nav-link">Orders</a>
                @endrole

                {{-- Admin --}}
                @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('admin.products.pending') }}" class="nav-link">Pending Products</a>
                    <a href="{{ route('admin.prescriptions.index') }}" class="nav-link">Prescriptions</a>
                @endrole

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link text-red-600">Logout</button>
                </form>
            @endauth

        </div>
    </div>
    <style>
.nav-link {
    padding: 6px 12px;
    border-radius: 6px;
    transition: all .2s ease;
}
.nav-link:hover {
    background-color: #f3f4f6;
}
</style>

</nav>
