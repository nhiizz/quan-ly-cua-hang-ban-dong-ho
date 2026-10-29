@extends('layouts.admin')

@section('title', 'Edit Order Detail')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Order Detail</h2>
        <p class="text-muted mb-0">Update product quantity in this order</p>
    </div>

    <a href="{{ route('admin.order-details.index') }}" class="btn btn-secondary">
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

        <form
            action="{{ route('admin.order-details.update', $orderDetail->OrderDetailID) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="row">

                {{-- ORDER --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Order</label>

                    <input
                        type="text"
                        class="form-control"
                        value="Order #{{ $order->OrderID }}"
                        readonly
                    >

                    <small class="text-muted">
                        Order cannot be changed.
                    </small>
                </div>

                {{-- PRODUCT --}}
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
                                {{ old('Product_ID', $orderDetail->Product_ID) == $product->Product_ID ? 'selected' : '' }}
                            >
                                {{ $product->ProductName }}
                                -
                                {{ number_format($product->Price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>

                    @error('Product_ID')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- QUANTITY --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity</label>

                    <input
                        type="number"
                        name="Quantity"
id="Quantity"
                        class="form-control"
                        min="1"
                        value="{{ old('Quantity', $orderDetail->Quantity) }}"
                        required
                    >

                    @error('Quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- UNIT PRICE --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Unit Price</label>

                    <input
                        type="text"
                        id="UnitPriceDisplay"
                        class="form-control"
                        readonly
                    >

                    <small class="text-muted">
                        Unit price is automatically taken from the product.
                    </small>
                </div>

                {{-- SUBTOTAL --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Subtotal</label>

                    <input
                        type="text"
                        id="SubtotalDisplay"
                        class="form-control"
                        readonly
                    >

                    <small class="text-muted">
                        Subtotal = Quantity × Unit Price
                    </small>
                </div>

            </div>

            <div class="mt-3">

                <button type="submit" class="btn btn-primary">
                    Update Order Detail
                </button>

                <a
                    href="{{ route('admin.order-details.index') }}"
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

    const unitPriceDisplay = document.getElementById('UnitPriceDisplay');
    const subtotalDisplay = document.getElementById('SubtotalDisplay');


    function updatePrice()
    {
        const selectedOption =
            productSelect.options[productSelect.selectedIndex];

        if (!selectedOption || !selectedOption.value) {
            unitPriceDisplay.value = '';
            subtotalDisplay.value = '';
            return;
        }

        const price =
            parseFloat(selectedOption.dataset.price) || 0;

        const quantity =
            parseInt(quantityInput.value) || 0;

        const subtotal =
            price * quantity;

        unitPriceDisplay.value =
            new Intl.NumberFormat('vi-VN').format(price);

        subtotalDisplay.value =
            new Intl.NumberFormat('vi-VN').format(subtotal);
    }


    productSelect.addEventListener('change', updatePrice);

    quantityInput.addEventListener('input', updatePrice);
updatePrice();

</script>

@endsection
