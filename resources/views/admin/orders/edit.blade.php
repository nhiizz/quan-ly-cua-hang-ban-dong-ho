@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Order</h2>
        <p class="text-muted mb-0">Update order information</p>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.orders.update', $order->OrderID) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- Customer --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Customer</label>

                    <select name="Account_ID" class="form-select" required>

                        <option value="">Select customer</option>

                        @foreach($accounts as $account)

                            <option
                                value="{{ $account->Account_ID }}"
                                {{ old('Account_ID', $order->Account_ID) == $account->Account_ID ? 'selected' : '' }}
                            >
                                {{ $account->FullName }}
                            </option>

                        @endforeach

                    </select>

                    @error('Account_ID')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Receiver Name --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Receiver Name</label>

                    <input
                        type="text"
                        name="ReceiverName"
                        class="form-control"
                        value="{{ old('ReceiverName', $order->ReceiverName) }}"
                        required
                    >

                    @error('ReceiverName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Phone --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        name="Phone"
                        class="form-control"
                        value="{{ old('Phone', $order->Phone) }}"
                        required
                    >

                    @error('Phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
{{-- Shipping Address --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Shipping Address</label>

                    <input
                        type="text"
                        name="ShippingAddress"
                        class="form-control"
                        value="{{ old('ShippingAddress', $order->ShippingAddress) }}"
                        required
                    >

                    @error('ShippingAddress')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Total Amount --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Amount</label>

                    <input
                        type="number"
                        name="TotalAmount"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('TotalAmount', $order->TotalAmount) }}"
                        required
                    >

                    @error('TotalAmount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Payment Status --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Status</label>

                    <select name="PaymentStatus" class="form-select" required>

                        <option value="Pending"
                            {{ old('PaymentStatus', $order->PaymentStatus) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Paid"
                            {{ old('PaymentStatus', $order->PaymentStatus) == 'Paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                    </select>

                    @error('PaymentStatus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        When the payment status is changed to Paid, a payment record will be created automatically.
                    </small>
                </div>


                {{-- Payment Method --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Method</label>

                    <input
                        type="text"
                        name="PaymentMethod"
                        class="form-control"
                        value="{{ old('PaymentMethod', $order->PaymentMethod) }}"
                        readonly
                    >

                    <small class="text-muted">
                        Payment method is managed for this order.
                    </small>
@error('PaymentMethod')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Order Status --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Order Status</label>

                    <select name="OrderStatus" class="form-select" required>

                        <option value="Pending"
                            {{ old('OrderStatus', $order->OrderStatus) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Processing"
                            {{ old('OrderStatus', $order->OrderStatus) == 'Processing' ? 'selected' : '' }}>
                            Processing
                        </option>

                        <option value="Shipping"
                            {{ old('OrderStatus', $order->OrderStatus) == 'Shipping' ? 'selected' : '' }}>
                            Shipping
                        </option>

                        <option value="Completed"
                            {{ old('OrderStatus', $order->OrderStatus) == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="Cancelled"
                            {{ old('OrderStatus', $order->OrderStatus) == 'Cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                    @error('OrderStatus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="mt-3">

                <button type="submit" class="btn btn-primary">
                    Update Order
                </button>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>
</div>

@endsection
