@extends('layouts.admin')

@section('title', 'Account Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Account Management</h2>
        <p class="text-muted mb-0">Manage system accounts</p>
    </div>

    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">
        Add Account
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
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($accounts as $account)

                        <tr>

                            <td>
                                {{ $account->Account_ID }}
                            </td>

                            <td>
                                <strong>{{ $account->UserName }}</strong>
                            </td>

                            <td>
                                {{ $account->FullName }}
                            </td>

                            <td>
                                {{ $account->Email ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $account->PhoneNumber ?? 'N/A' }}
                            </td>

                            <td>
                                @if($account->Role === 'Admin')
                                    <span class="badge bg-danger">
                                        Admin
                                    </span>
                                @else
                                    <span class="badge bg-primary">
                                        Customer
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($account->Status)
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>
                                @endif
                            </td>
<td>
                                {{ $account->CreatedAt ? $account->CreatedAt->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.accounts.edit', $account->Account_ID) }}"
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.accounts.destroy', $account->Account_ID) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this account?');"
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
                            <td colspan="9" class="text-center text-muted py-4">
                                No accounts found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection