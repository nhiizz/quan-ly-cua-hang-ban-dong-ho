@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Brand Management</h1>
            <p class="text-muted">Manage product brands</p>
        </div>

        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            + Add Brand
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Brand Name</th>
                        <th>Country</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($brands as $brand)

                    <tr>
                        <td>{{ $brand->Brand_ID }}</td>

                        <td>
                            <strong>{{ $brand->BrandName }}</strong>
                        </td>

                        <td>
                            {{ $brand->Country ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $brand->Description ?? 'No description' }}
                        </td>

                        <td>
                            @if($brand->Status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.brands.edit', $brand->Brand_ID) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.brands.destroy', $brand->Brand_ID) }}"
                                  method="POST"
                                  style="display:inline-block;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this brand?')">
                                    Delete
                                </button>

                            </form>
                        </td>
                    </tr>

                    @empty

                    <tr>
<td colspan="6" class="text-center">
                            No brands found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
