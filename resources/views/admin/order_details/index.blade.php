@extends('layouts.admin')

@section('title', 'Order Detail Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Order Detail Management</h2>
        <p class="text-muted mb-0">Manage products included in orders</p>
    </div>

    <a href="{{ route('admin.order-details.create') }}" class="btn btn-primary">
        Add Order Detail
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
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orderDetails as $detail)

                        <tr>

                            <td>
                                {{ $detail->OrderDetailID }}
                            </td>

                            <td>
                                #{{ $detail->OrderID }}
                            </td>

                            <td>
                                {{ $detail->product->ProductName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $detail->Quantity }}
                            </td>

                            <td>
                                {{ number_format($detail->UnitPrice, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ number_format($detail->Subtotal, 0, ',', '.') }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.order-details.edit', $detail->OrderDetailID) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.order-details.destroy', $detail->OrderDetailID) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this order detail?');"
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
                            <td colspan="7" class="text-center text-muted py-4">
                                No order details found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection
