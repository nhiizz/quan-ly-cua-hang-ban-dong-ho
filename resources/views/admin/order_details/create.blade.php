@extends('layouts.admin')

@section('title', 'Add Product to Order')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Add Product to Order #{{ $order->OrderID }}</h2>
        <p class="text-muted mb-0">Add a product to this order</p>
    </div>

    <a
        href="{{ route('admin.orders.show', $order->OrderID) }}"
        class="btn btn-secondary"
    >
        Back
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.orders.products.store', $order->OrderID) }}" method="POST">
    @csrf

            <input
                type="hidden"
                name="OrderID"
                value="{{ $order->OrderID }}"
            >

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Order</label>

                    <input
                        type="text"
                        class="form-control"
                        value="Order #{{ $order->OrderID }} - {{ $order->ReceiverName }}"
                        readonly
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Product</label>

                    <select
                        name="Product_ID"
                        id="Product_ID"
                        class="form-select"
                        required
                    >
                        <option value="">Select product</option>

                        @foreach($products as $product)
                            <option
                                value="{{ $product->Product_ID }}"
                                data-price="{{ $product->Price }}"
                                {{ old('Product_ID') == $product->Product_ID ? 'selected' : '' }}
                            >
                                {{ $product->ProductName }}
                            </option>
                        @endforeach
                    </select>

                    @error('Product_ID')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity</label>

                    <input
                        type="number"
                        name="Quantity"
                        id="Quantity"
                        class="form-control"
                        min="1"
                        value="{{ old('Quantity', 1) }}"
                        required
                    >
@error('Quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Unit Price</label>

                    <input
                        type="text"
                        id="UnitPrice"
                        class="form-control"
                        value=""
                        readonly
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Subtotal</label>

                    <input
                        type="text"
                        id="Subtotal"
                        class="form-control"
                        value=""
                        readonly
                    >
                </div>

            </div>

            <div class="mt-3">

                <button type="submit" class="btn btn-primary">
                    Add Product
                </button>

                <a
                    href="{{ route('admin.orders.show', $order->OrderID) }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>
</div>

<script>
    const productSelect = document.getElementById('Product_ID');
    const quantityInput = document.getElementById('Quantity');
    const unitPriceInput = document.getElementById('UnitPrice');
    const subtotalInput = document.getElementById('Subtotal');

    function updatePrice() {
        const option = productSelect.options[productSelect.selectedIndex];

        const price = option.dataset.price
            ? parseFloat(option.dataset.price)
            : 0;

        const quantity = parseInt(quantityInput.value) || 0;

        unitPriceInput.value = price.toLocaleString('vi-VN');

        subtotalInput.value = (price * quantity).toLocaleString('vi-VN');
    }

    productSelect.addEventListener('change', updatePrice);
    quantityInput.addEventListener('input', updatePrice);

    updatePrice();
</script>

@endsection
