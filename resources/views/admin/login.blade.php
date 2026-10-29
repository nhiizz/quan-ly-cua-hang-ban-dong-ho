<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Chrono Pulse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 420px;
            border: none;
            border-radius: 15px;
            padding: 30px;
        }

        .logo {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

<div class="card shadow login-card">

    <div class="logo">
        CHRONO PULSE
    </div>

    <div class="subtitle">
        Admin Management System
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">
                Username
            </label>

            <input
                type="text"
                name="UserName"
                class="form-control"
                value="{{ old('UserName') }}"
                placeholder="Enter username"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">
                Password
            </label>

            <input
                type="password"
                name="Password"
                class="form-control"
                placeholder="Enter password"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>

    </form>

</div>

</body>
</html>
