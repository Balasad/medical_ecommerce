<h2>Create Product</h2>

<form method="POST" action="{{ route('vendor.products.store') }}">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name"><br><br>

    <label>SKU</label><br>
    <input type="text" name="sku"><br><br>

    <label>Price</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <label>Stock</label><br>
    <input type="number" name="stock"><br><br>

    <label>
        <input type="checkbox" name="requires_prescription" value="1">
        Requires Prescription
    </label><br><br>

    <button type="submit">Save as Draft</button>
</form>
