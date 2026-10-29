@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h1>Edit Brand</h1>
        <p class="text-muted">Update brand information</p>
    </div>

    <div class="card">
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.brands.update', $brand->Brand_ID) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Brand Name</label>
                    <input type="text"
                           name="BrandName"
                           class="form-control"
                           value="{{ old('BrandName', $brand->BrandName) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text"
                           name="Country"
                           class="form-control"
                           value="{{ old('Country', $brand->Country) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="text"
                           name="Logo"
                           class="form-control"
                           value="{{ old('Logo', $brand->Logo) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="Description"
                              class="form-control"
                              rows="4">{{ old('Description', $brand->Description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="Status" class="form-select" required>

                        <option value="1"
                            {{ old('Status', $brand->Status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('Status', $brand->Status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Brand
                </button>

                <a href="{{ route('admin.brands.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>
</div>
    </div>

</div>

@endsection
