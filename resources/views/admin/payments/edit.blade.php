@extends('layouts.admin')

@section('title', 'Edit Payment')

@section('content')

<div class="container-fluid">

    <h2 class="mb-2">Edit Payment</h2>
    <p class="text-muted">Update payment information</p>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.payments.update', $payment->PaymentID) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Order</label>

                        <select name="OrderID" class="form-select" required>

                            @foreach($orders as $order)

                                <option
                                    value="{{ $order->OrderID }}"
                                    {{ $payment->OrderID == $order->OrderID ? 'selected' : '' }}
                                >
                                    Order #{{ $order->OrderID }}
                                    - {{ number_format($order->TotalAmount, 0, ',', '.') }}
                                </option>

                            @endforeach

                        </select>
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Payment Method</label>

                        <select name="PaymentMethod" class="form-select" required>

                            <option value="Cash"
                                {{ $payment->PaymentMethod == 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="Bank Transfer"
                                {{ $payment->PaymentMethod == 'Bank Transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                            <option value="Credit Card"
                                {{ $payment->PaymentMethod == 'Credit Card' ? 'selected' : '' }}>
                                Credit Card
                            </option>

                        </select>
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Transaction Code</label>

                        <input
                            type="text"
                            name="TransactionCode"
                            class="form-control"
                            value="{{ $payment->TransactionCode }}"
                        >
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Amount</label>

                        <input
                            type="number"
                            name="Amount"
                            class="form-control"
                            min="0"
                            step="0.01"
value="{{ $payment->Amount }}"
                            required
                        >
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Payment Date</label>

                        <input
                            type="datetime-local"
                            name="PaymentDate"
                            class="form-control"
                            value="{{ $payment->PaymentDate ? $payment->PaymentDate->format('Y-m-d\TH:i') : '' }}"
                        >
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Payment Status</label>

                        <select name="PaymentStatus" class="form-select" required>

                            <option value="Pending"
                                {{ $payment->PaymentStatus == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Paid"
                                {{ $payment->PaymentStatus == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                            <option value="Failed"
                                {{ $payment->PaymentStatus == 'Failed' ? 'selected' : '' }}>
                                Failed
                            </option>

                        </select>
                    </div>

                </div>


                <button type="submit" class="btn btn-primary">
                    Update Payment
                </button>

                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
