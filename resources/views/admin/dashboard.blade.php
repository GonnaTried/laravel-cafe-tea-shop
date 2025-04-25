@extends('admin.layout.index')

@section('content')
    <h1 class="title">Admin Dashboard</h1>

    <div class="columns is-multiline">
        <div class="column is-one-third">
            <div class="card has-background-dark">
                <div class="card-header">
                    <p class="card-header-title">Total Customers</p>
                </div>
                <div class="card-content ">
                    <p class="title is-4">{{ $totalCustomerCount }}</p>
                    {{-- <a href="{{ route('admin.users.index') }}" class="button is-primary is-small">Manage Customers</a> --}}
                </div>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="card has-background-dark">
                <div class="card-header">
                    <p class="card-header-title">New Users this Month</p>
                </div>
                <div class="card-content">
                    <p class="title is-4">{{ $newUserCountMonthly }}</p>
                    {{-- <a href="{{ route('admin.products.index') }}" class="button is-info is-small">Manage Products</a> --}}
                </div>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="card has-background-dark">
                <div class="card-header">
                    <p class="card-header-title has-text-info">Total Products</p>
                </div>
                <div class="card-content">
                    <p class="title is-4">{{ $totalProductCount }}</p>
                    {{-- <a href="{{ route('admin.products.index') }}" class="button is-info is-small">Manage Products</a> --}}
                </div>
            </div>
        </div>

        <div class="column is-one-third">
            <div class="card has-background-dark">
                <div class="card-header">
                    <p class="card-header-title has-text-warning">Total Income This Month</p>
                </div>
                <div class="card-content">
                    <p class="title is-4 ">{{ $totalIncomeMonthly . ' $' }}</p>
                    {{-- <a href="{{ route('admin.products.index') }}" class="button is-info is-small">Manage Products</a> --}}
                </div>
            </div>
        </div>




    </div>



    <div class="card mt-4 has-background-dark">
        <div class="card-header">
            <p class="card-header-title">Quick Links</p>
        </div>
        <div class="card-content">
            <div class="buttons">
                <a href="admin/products" class="button is-info">Product Management</a>
                <a href="admin/users" class="button is-primary">Users Management</a>
            </div>
        </div>
    </div>
@endsection
