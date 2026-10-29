@extends('layouts.admin')

@section('title', 'Edit Inventory')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Inventory</h2>
        <p class="text-muted mb-0">Update inventory information</p>
    </div>

    <a href="{{ route('admin.inventories.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.inventories.update', $inventory->InventoryID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Product</label>

                    <select name="Product_ID" class="form-select" required>
                        <option value="">Select product</option>

                        @foreach($products as $product)
                            <option
                                value="{{ $product->Product_ID }}"
                                {{ old('Product_ID', $inventory->Product_ID) == $product->Product_ID ? 'selected' : '' }}
                            >
                                {{ $product->ProductName }}
                            </option>
                        @endforeach
                    </select>

                    @error('Product_ID')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Import Quantity</label>

                    <input
                        type="number"
                        name="ImportQuantity"
                        class="form-control"
                        min="0"
                        value="{{ old('ImportQuantity', $inventory->ImportQuantity) }}"
                        required
                    >

                    @error('ImportQuantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Export Quantity</label>

                    <input
                        type="number"
                        name="ExportQuantity"
                        class="form-control"
                        min="0"
                        value="{{ old('ExportQuantity', $inventory->ExportQuantity) }}"
                        required
                    >

                    @error('ExportQuantity')
                        <div class="text-danger">{{ $message }}</div>
@enderror
                </div>

            </div>

            <div class="alert alert-info mt-2">
                <strong>Stock Quantity:</strong>
                {{ $inventory->StockQuantity }}
                <br>
                <small>
                    Automatically calculated as Import Quantity − Export Quantity.
                </small>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    Update Inventory
                </button>

                <a
                    href="{{ route('admin.inventories.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection