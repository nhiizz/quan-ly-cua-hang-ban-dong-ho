@extends('layouts.admin')

@section('title', 'Inventory Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Inventory Management</h2>
        <p class="text-muted mb-0">Manage product inventory</p>
    </div>

    <a href="{{ route('admin.inventories.create') }}" class="btn btn-primary">
        Add Inventory
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
                        <th>Product</th>
                        <th>Import Quantity</th>
                        <th>Export Quantity</th>
                        <th>Stock Quantity</th>
                        <th>Updated At</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($inventories as $inventory)

                        <tr>

                            <td>
                                {{ $inventory->InventoryID }}
                            </td>

                            <td>
                                {{ $inventory->product->ProductName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $inventory->ImportQuantity }}
                            </td>

                            <td>
                                {{ $inventory->ExportQuantity }}
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $inventory->StockQuantity }}
                                </span>
                            </td>

                            <td>
                                {{ $inventory->UpdatedAt ? $inventory->UpdatedAt->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.inventories.edit', $inventory->InventoryID) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.inventories.destroy', $inventory->InventoryID) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this inventory?');"
                                >
@csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No inventory records found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection