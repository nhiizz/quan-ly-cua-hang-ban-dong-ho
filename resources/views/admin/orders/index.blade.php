@extends('layouts.admin')

@section('title', 'Order Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Order Management</h2>
        <p class="text-muted mb-0">Manage customer orders</p>
    </div>

    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
        Add Order
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
                        <th>Customer</th>
                        <th>Receiver</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                        <th>Payment</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            <td>
                                {{ $order->OrderID }}
                            </td>

                            <td>
                                {{ $order->account->FullName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $order->ReceiverName }}
                            </td>

                            <td>
                                {{ $order->Phone }}
                            </td>

                            <td>
                                {{ number_format($order->TotalAmount, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($order->PaymentStatus === 'Paid')
                                    <span class="badge bg-success">
                                        Paid
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($order->OrderStatus === 'Pending')
                                    <span class="badge bg-secondary">
                                        Pending
                                    </span>
                                @elseif($order->OrderStatus === 'Processing')
                                    <span class="badge bg-primary">
                                        Processing
                                    </span>
@elseif($order->OrderStatus === 'Shipping')
                                    <span class="badge bg-info text-dark">
                                        Shipping
                                    </span>
                                @elseif($order->OrderStatus === 'Completed')
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $order->OrderDate ? $order->OrderDate->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.orders.show', $order->OrderID) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('admin.orders.edit', $order->OrderID) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.orders.destroy', $order->OrderID) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this order?');"
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
                            <td colspan="9" class="text-center text-muted py-4">
                                No orders found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection
