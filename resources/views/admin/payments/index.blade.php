@extends('layouts.admin')

@section('title', 'Payment Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Payment Management</h2>
        <p class="text-muted mb-0">Manage customer payments</p>
    </div>

    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
        Add Payment
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Transaction Code</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($payments as $payment)

                        <tr>

                            <td>
                                {{ $payment->PaymentID }}
                            </td>

                            <td>
                                #{{ $payment->OrderID }}
                            </td>

                            <td>
                                {{ $payment->PaymentMethod }}
                            </td>

                            <td>
                                {{ $payment->TransactionCode ?? 'N/A' }}
                            </td>

                            <td>
                                {{ number_format($payment->Amount, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $payment->PaymentDate ? $payment->PaymentDate->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            <td>
                                @if($payment->PaymentStatus === 'Paid')
                                    <span class="badge bg-success">
                                        Paid
                                    </span>
                                @elseif($payment->PaymentStatus === 'Failed')
                                    <span class="badge bg-danger">
                                        Failed
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <td>

                                <a
href="{{ route('admin.payments.edit', $payment->PaymentID) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.payments.destroy', $payment->PaymentID) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this payment?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No payments found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection
