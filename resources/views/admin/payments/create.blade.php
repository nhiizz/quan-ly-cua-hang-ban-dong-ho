@extends('layouts.admin')

@section('title', 'Add Payment')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Add Payment</h2>
        <p class="text-muted mb-0">Create a new payment record</p>
    </div>

    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.payments.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Order</label>

                    <select name="OrderID" class="form-select" required>
                        <option value="">Select order</option>

                        @foreach($orders as $order)
                            <option
                                value="{{ $order->OrderID }}"
                                {{ old('OrderID') == $order->OrderID ? 'selected' : '' }}
                            >
                                Order #{{ $order->OrderID }}
                                - {{ number_format($order->TotalAmount, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>

                    @error('OrderID')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
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

                <div class="col-md-6 mb-3">
                    <label class="form-label">Transaction Code</label>
<input
                        type="text"
                        name="TransactionCode"
                        class="form-control"
                        value="{{ old('TransactionCode') }}"
                    >

                    @error('TransactionCode')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount</label>

                    <input
                        type="number"
                        name="Amount"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('Amount') }}"
                        required
                    >

                    @error('Amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Date</label>

                    <input
                        type="datetime-local"
                        name="PaymentDate"
                        class="form-control"
                        value="{{ old('PaymentDate') }}"
                    >

                    @error('PaymentDate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
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

                        <option value="Failed"
                            {{ old('PaymentStatus') == 'Failed' ? 'selected' : '' }}>
                            Failed
                        </option>
                    </select>

                    @error('PaymentStatus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    Add Payment
                </button>

                <a
                    href="{{ route('admin.payments.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
