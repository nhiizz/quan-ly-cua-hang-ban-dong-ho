@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Add Product</h2>
            <p class="text-muted">Create a new product</p>
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

            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Product Name --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input
                            type="text"
                            name="ProductName"
                            class="form-control"
                            placeholder="Enter product name"
                            value="{{ old('ProductName') }}"
                            required
                        >

                        @error('ProductName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Brand --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>

                        <select name="Brand_ID" class="form-select" required>
                            <option value="">Select brand</option>

                            @foreach ($brands as $brand)
                                <option
                                    value="{{ $brand->Brand_ID }}"
                                    {{ old('Brand_ID') == $brand->Brand_ID ? 'selected' : '' }}
                                >
                                    {{ $brand->BrandName }}
                                </option>
                            @endforeach
                        </select>

                        @error('Brand_ID')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>

                        <select name="Category_ID" class="form-select" required>
                            <option value="">Select category</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->Category_ID }}"
{{ old('Category_ID') == $category->Category_ID ? 'selected' : '' }}
                                >
                                    {{ $category->CategoryName }}
                                </option>
                            @endforeach
                        </select>

                        @error('Category_ID')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gender</label>

                        <select name="Gender" class="form-select">
                            <option value="">Select gender</option>
                            <option value="Men" {{ old('Gender') == 'Men' ? 'selected' : '' }}>
                                Men
                            </option>
                            <option value="Women" {{ old('Gender') == 'Women' ? 'selected' : '' }}>
                                Women
                            </option>
                            <option value="Unisex" {{ old('Gender') == 'Unisex' ? 'selected' : '' }}>
                                Unisex
                            </option>
                        </select>

                        @error('Gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Movement Type --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Movement Type</label>

                        <input
                            type="text"
                            name="MovementType"
                            class="form-control"
                            placeholder="e.g. Automatic, Quartz"
                            value="{{ old('MovementType') }}"
                        >

                        @error('MovementType')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Water Resistance --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Water Resistance</label>

                        <input
                            type="text"
                            name="WaterResistance"
                            class="form-control"
                            placeholder="e.g. 100m"
                            value="{{ old('WaterResistance') }}"
                        >

                        @error('WaterResistance')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Warranty Period --}}
                    <div class="col-md-6 mb-3">
<label class="form-label">Warranty Period</label>

                        <input
                            type="text"
                            name="WarrantyPeriod"
                            class="form-control"
                            placeholder="e.g. 2 years"
                            value="{{ old('WarrantyPeriod') }}"
                        >

                        @error('WarrantyPeriod')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Glass Material --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Glass Material</label>

                        <input
                            type="text"
                            name="GlassMaterial"
                            class="form-control"
                            placeholder="e.g. Sapphire Crystal"
                            value="{{ old('GlassMaterial') }}"
                        >

                        @error('GlassMaterial')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dial Color --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dial Color</label>

                        <input
                            type="text"
                            name="DialColor"
                            class="form-control"
                            placeholder="e.g. Black"
                            value="{{ old('DialColor') }}"
                        >

                        @error('DialColor')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Strap Material --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Strap Material</label>

                        <input
                            type="text"
                            name="StrapMaterial"
                            class="form-control"
                            placeholder="e.g. Leather"
                            value="{{ old('StrapMaterial') }}"
                        >

                        @error('StrapMaterial')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Case Material --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Case Material</label>

                        <input
                            type="text"
                            name="CaseMaterial"
                            class="form-control"
                            placeholder="e.g. Stainless Steel"
value="{{ old('CaseMaterial') }}"
                        >

                        @error('CaseMaterial')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Quantity --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>

                        <input
                            type="number"
                            name="Quantity"
                            class="form-control"
                            placeholder="Enter quantity"
                            min="0"
                            value="{{ old('Quantity', 0) }}"
                            required
                        >

                        @error('Quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price</label>
                <input

                            type="number"

                            name="Price"

                            class="form-control"

                            placeholder="Enter price"

                            min="0"

                            step="0.01"

                            value="{{ old('Price') }}"

                            required

                        >

                        @error('Price')

                            <div class="text-danger">{{ $message }}</div>

                        @enderror

                    </div>

                    {{-- Description --}}

                    <div class="col-12 mb-3">

                        <label class="form-label">Description</label>

                        <textarea

                            name="Description"

                            class="form-control"

                            rows="4"

                            placeholder="Enter product description"

                        >{{ old('Description') }}</textarea>

                        @error('Description')

                            <div class="text-danger">{{ $message }}</div>

                        @enderror

                    </div>

                    {{-- Status --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Status</label>

                        <select name="Status" class="form-select" required>

                            <option value="1" {{ old('Status', '1') == '1' ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="0" {{ old('Status') == '0' ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                        @error('Status')

                            <div class="text-danger">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

                <div class="mt-3">

                    <button type="submit" class="btn btn-primary">

                        Add Product

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