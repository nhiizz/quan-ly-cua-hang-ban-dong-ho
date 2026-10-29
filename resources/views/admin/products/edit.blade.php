@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Edit Product</h2>
            <p class="text-muted">Update product information</p>
        </div>
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

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.products.update', $product->Product_ID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input
                            type="text"
                            name="ProductName"
                            class="form-control"
                            value="{{ old('ProductName', $product->ProductName) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>
                        <select name="Brand_ID" class="form-select" required>
                            <option value="">Select brand</option>

                            @foreach ($brands as $brand)
                                <option
                                    value="{{ $brand->Brand_ID }}"
                                    {{ old('Brand_ID', $product->Brand_ID) == $brand->Brand_ID ? 'selected' : '' }}
                                >
                                    {{ $brand->BrandName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="Category_ID" class="form-select" required>
                            <option value="">Select category</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->Category_ID }}"
                                    {{ old('Category_ID', $product->Category_ID) == $category->Category_ID ? 'selected' : '' }}
                                >
                                    {{ $category->CategoryName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
<label class="form-label">Gender</label>
                        <select name="Gender" class="form-select">
                            <option value="">Select gender</option>

                            <option value="Men"
                                {{ old('Gender', $product->Gender) == 'Men' ? 'selected' : '' }}>
                                Men
                            </option>

                            <option value="Women"
                                {{ old('Gender', $product->Gender) == 'Women' ? 'selected' : '' }}>
                                Women
                            </option>

                            <option value="Unisex"
                                {{ old('Gender', $product->Gender) == 'Unisex' ? 'selected' : '' }}>
                                Unisex
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Movement Type</label>
                        <input
                            type="text"
                            name="MovementType"
                            class="form-control"
                            value="{{ old('MovementType', $product->MovementType) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Water Resistance</label>
                        <input
                            type="text"
                            name="WaterResistance"
                            class="form-control"
                            value="{{ old('WaterResistance', $product->WaterResistance) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warranty Period</label>
                        <input
                            type="text"
                            name="WarrantyPeriod"
                            class="form-control"
                            value="{{ old('WarrantyPeriod', $product->WarrantyPeriod) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Glass Material</label>
                        <input
                            type="text"
                            name="GlassMaterial"
                            class="form-control"
                            value="{{ old('GlassMaterial', $product->GlassMaterial) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dial Color</label>
                        <input
                            type="text"
                            name="DialColor"
                            class="form-control"
value="{{ old('DialColor', $product->DialColor) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Strap Material</label>
                        <input
                            type="text"
                            name="StrapMaterial"
                            class="form-control"
                            value="{{ old('StrapMaterial', $product->StrapMaterial) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Case Material</label>
                        <input
                            type="text"
                            name="CaseMaterial"
                            class="form-control"
                            value="{{ old('CaseMaterial', $product->CaseMaterial) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input
                            type="number"
                            name="Quantity"
                            class="form-control"
                            min="0"
                            value="{{ old('Quantity', $product->Quantity) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                        <input
                            type="number"
                            name="Price"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="{{ old('Price', $product->Price) }}"
                            required
                        >
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>

                        <textarea
                            name="Description"
                            class="form-control"
                            rows="4"
                            placeholder="Enter product description"
                        >{{ old('Description', $product->Description) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>

                        <select name="Status" class="form-select" required>
                            <option value="1"
                                {{ old('Status', $product->Status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
{{ old('Status', $product->Status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Update Product
                    </button>

                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
