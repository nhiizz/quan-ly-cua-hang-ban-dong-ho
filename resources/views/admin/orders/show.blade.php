@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Order #{{ $order->OrderID }}</h2>
        <p class="text-muted mb-0">View order information and products</p>
    </div>

    <a
        href="{{ route('admin.orders.index') }}"
        class="btn btn-secondary"
    >
        Back
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <h5 class="mb-3">Customer Information</h5>

        <div class="row">

            <div class="col-md-6 mb-2">
                <strong>Customer:</strong>
                {{ $order->account->FullName ?? 'N/A' }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Receiver:</strong>
                {{ $order->ReceiverName }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Phone:</strong>
                {{ $order->Phone }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Payment Method:</strong>
                {{ $order->PaymentMethod }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Payment Status:</strong>
                {{ $order->PaymentStatus }}
            </div>

            <div class="col-md-6 mb-2">
                <strong>Order Status:</strong>
                {{ $order->OrderStatus }}
            </div>

            <div class="col-12 mb-2">
                <strong>Shipping Address:</strong>
                {{ $order->ShippingAddress }}
            </div>

        </div>

    </div>
</div>

<div class="card shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="mb-0">Products in this Order</h5>

<a
    href="{{ route('admin.orders.products.create', ['order' => $order->OrderID]) }}"
    class="btn btn-sm btn-primary"
>
    Add Product
</a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($order->orderDetails as $detail)

                        <tr>

                            <td>
                                {{ $detail->OrderDetailID }}
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

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No products in this order.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

                <tfoot>

                    <tr>
                        <th colspan="4" class="text-end">
                            Total Amount
                        </th>

                        <th>
                            {{ number_format($order->TotalAmount, 0, ',', '.') }}
                        </th>
                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>

@endsection
