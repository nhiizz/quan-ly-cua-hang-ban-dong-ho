@extends('layouts.admin')

@section('title', 'Add Order')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Add Order</h2>
        <p class="text-muted mb-0">Create a new customer order</p>
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

        <form action="{{ route('admin.orders.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Customer</label>

                    <select name="Account_ID" class="form-select" required>
                        <option value="">Select customer</option>

                        @foreach($accounts as $account)
                            <option
                                value="{{ $account->Account_ID }}"
                                {{ old('Account_ID') == $account->Account_ID ? 'selected' : '' }}
                            >
                                {{ $account->FullName }} - {{ $account->UserName }}
                            </option>
                        @endforeach
                    </select>

                    @error('Account_ID')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Receiver Name</label>

                    <input
                        type="text"
                        name="ReceiverName"
                        class="form-control"
                        value="{{ old('ReceiverName') }}"
                        required
                    >

                    @error('ReceiverName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        name="Phone"
                        class="form-control"
                        value="{{ old('Phone') }}"
                        required
                    >

                    @error('Phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Amount</label>

                    <input
                        type="number"
name="TotalAmount"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('TotalAmount', 0) }}"
                        required
                    >

                    @error('TotalAmount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Shipping Address</label>

                    <textarea
                        name="ShippingAddress"
                        class="form-control"
                        rows="3"
                        required
                    >{{ old('ShippingAddress') }}</textarea>

                    @error('ShippingAddress')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Payment Method</label>

                    <select name="PaymentMethod" class="form-select" required>
                        <option value="">Select payment method</option>

                        <option value="Cash"
                            {{ old('PaymentMethod') == 'Cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="Bank Transfer"
                            {{ old('PaymentMethod') == 'Bank Transfer' ? 'selected' : '' }}>
                            Bank Transfer
                        </option>

                        <option value="Credit Card"
                            {{ old('PaymentMethod') == 'Credit Card' ? 'selected' : '' }}>
                            Credit Card
                        </option>
                    </select>

                    @error('PaymentMethod')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Payment Status</label>

                    <select name="PaymentStatus" class="form-select" required>
                        <option value="Pending"
                            {{ old('PaymentStatus', 'Pending') == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Paid"
                            {{ old('PaymentStatus') == 'Paid' ? 'selected' : '' }}>
                            Paid
                        </option>
                    </select>

                    @error('PaymentStatus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Order Status</label>
<select name="OrderStatus" class="form-select" required>
                        <option value="Pending"
                            {{ old('OrderStatus', 'Pending') == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Processing"
                            {{ old('OrderStatus') == 'Processing' ? 'selected' : '' }}>
                            Processing
                        </option>

                        <option value="Shipping"
                            {{ old('OrderStatus') == 'Shipping' ? 'selected' : '' }}>
                            Shipping
                        </option>

                        <option value="Completed"
                            {{ old('OrderStatus') == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="Cancelled"
                            {{ old('OrderStatus') == 'Cancelled' ? 'selected' : '' }}>
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
                    Add Order
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