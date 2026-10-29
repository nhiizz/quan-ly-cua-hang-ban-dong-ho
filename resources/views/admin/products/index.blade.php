@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Product Management</h1>
            <p class="text-muted">Manage all products</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            Add Product
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Gender</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($products as $product)

                        <tr>
                            <td>{{ $product->Product_ID }}</td>

                            <td>
                                <strong>{{ $product->ProductName }}</strong>
                            </td>

                            <td>
                                {{ $product->brand->BrandName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $product->category->CategoryName ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $product->Gender ?? 'N/A' }}
                            </td>

                            <td>
                                ${{ number_format($product->Price, 2) }}
                            </td>

                            <td>
                                {{ $product->Quantity }}
                            </td>

                            <td>
                                @if($product->Status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td>

                                <a href="{{ route('admin.products.edit', $product->Product_ID) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->Product_ID) }}"
                                      method="POST"
                                      class="d-inline">
@csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="text-center">
                                No products found.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection