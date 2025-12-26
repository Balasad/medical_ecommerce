<nav class="bg-white shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    <a href="/" class="text-xl font-bold text-brand">MediStore</a>

    <div class="flex gap-6 items-center">

      <a href="{{ route('products.index') }}">Medicines</a>

      @auth
        @role('customer')
        <a href="{{ route('orders.index') }}">My Orders</a>
        <a href="{{ route('prescriptions.create') }}">Upload Rx</a>
        @endrole

        @role('vendor')
          <a href="{{ route('vendor.orders.index') }}">Vendor Orders</a>
        @endrole

        @role('admin')
          <a href="{{ route('admin.products.pending') }}">Admin</a>
        @endrole

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="text-red-600">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}"
           class="bg-brand text-white px-4 py-2 rounded">
          Register
        </a>
      @endauth

    </div>
  </div>
</nav>
