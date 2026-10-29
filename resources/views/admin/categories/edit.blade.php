@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Category</h2>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.categories.update', $category->Category_ID) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Category Name</label>

                    <input type="text"
                           name="CategoryName"
                           class="form-control"
                           value="{{ old('CategoryName', $category->CategoryName) }}"
                           required>

                    @error('CategoryName')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea name="Description"
                              class="form-control"
                              rows="4">{{ old('Description', $category->Description) }}</textarea>
                </div>


                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="Status" class="form-select">

                        <option value="1"
                            {{ old('Status', $category->Status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('Status', $category->Status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>


                <button type="submit" class="btn btn-primary">
                    Update Category
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection