@extends('layouts.admin')

@section('title', 'Edit Account')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Account</h2>
        <p class="text-muted mb-0">Update account information</p>
    </div>

    <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.accounts.update', $account->Account_ID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Username</label>

                    <input
                        type="text"
                        name="UserName"
                        class="form-control"
                        value="{{ old('UserName', $account->UserName) }}"
                        required
                    >

                    @error('UserName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">New Password</label>

                    <input
                        type="password"
                        name="Password"
                        class="form-control"
                        placeholder="Leave blank to keep current password"
                    >

                    @error('Password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>

                    <input
                        type="text"
                        name="FullName"
                        class="form-control"
                        value="{{ old('FullName', $account->FullName) }}"
                        required
                    >

                    @error('FullName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="Email"
                        class="form-control"
                        value="{{ old('Email', $account->Email) }}"
                    >

                    @error('Email')
                        <div class="text-danger">{{ $message }}</div>
@error('Status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    Update Account
                </button>

                <a
                    href="{{ route('admin.accounts.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>

                    <input
                        type="text"
                        name="PhoneNumber"
                        class="form-control"
                        value="{{ old('PhoneNumber', $account->PhoneNumber) }}"
                    >

                    @error('PhoneNumber')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Role</label>

                    <select name="Role" class="form-select" required>
                        <option value="Admin"
                            {{ old('Role', $account->Role) == 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="Customer"
                            {{ old('Role', $account->Role) == 'Customer' ? 'selected' : '' }}>
                            Customer
                        </option>
                    </select>

                    @error('Role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Address</label>

                    <textarea
                        name="Address"
                        class="form-control"
                        rows="3"
                    >{{ old('Address', $account->Address) }}</textarea>

                    @error('Address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Avatar URL</label>

                    <input
                        type="text"
                        name="Avatar"
                        class="form-control"
                        value="{{ old('Avatar', $account->Avatar) }}"
                    >

                    @error('Avatar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>

                    <select name="Status" class="form-select" required>
                        <option value="1"
                            {{ old('Status', $account->Status) == '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('Status', $account->Status) == '0' ? 'selected' : '' }}>
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

                    Update Account

                </button>

                <a

                    href="{{ route('admin.accounts.index') }}"

                    class="btn btn-secondary"

                >

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection
