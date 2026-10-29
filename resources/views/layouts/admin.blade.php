<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Chrono Pulse Admin')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f5f6fa;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#1f2937;
            position:fixed;
        }

        .sidebar h4{
            color:white;
            text-align:center;
            padding:20px;
            border-bottom:1px solid #444;
        }

        .sidebar a{

            color:#d1d5db;
            display:block;

            padding:12px 20px;

            text-decoration:none;

            transition:.3s;

        }

        .sidebar a:hover{

            background:#2563eb;

            color:white;

        }

        .content{

            margin-left:250px;

            padding:25px;

        }

        .card{

            border:none;

            border-radius:15px;

        }

    </style>

</head>

<body>

<div class="sidebar">

<h4> CHRONO PULSE</h4>

<a href="{{ route('admin.dashboard') }}">
<i class="bi bi-speedometer2"></i>
Dashboard
</a>

<a href="{{ route('admin.categories.index') }}">
<i class="bi bi-grid"></i>
Category
</a>

<a href="{{ route('admin.brands.index') }}">
<i class="bi bi-award"></i>
Brand
</a>

<a href="{{ route('admin.products.index') }}">
<i class="bi bi-watch"></i>
Product
</a>

<a href="{{ route('admin.inventories.index') }}">
<i class="bi bi-box-seam"></i>
Inventory
</a>

<a href="{{ route('admin.orders.index') }}">
<i class="bi bi-cart-check"></i>
Order
</a>


<a href="{{ route('admin.payments.index') }}">
<i class="bi bi-credit-card"></i>
Payment
</a>

<a href="{{ route('admin.accounts.index') }}">
<i class="bi bi-people"></i>
Account
</a>

<hr class="text-light">

<form action="{{ route('admin.logout') }}" method="POST">
    @csrf

    <button type="submit"
            class="btn btn-link text-decoration-none w-100 text-start"
            style="color:#d1d5db; padding:12px 20px;">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </button>
</form>

</div>

<div class="content">

@yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>