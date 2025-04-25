@extends('staff.layout.index')

@section('title', 'Dashboard')

{{-- The main content for the dashboard goes here --}}
@section('content')
    <section class="section">
        <div class="container">

            {{-- Order Status Overview --}}
            <h2 class="title is-5">Order Overview</h2>
            <div class="columns is-multiline is-centered"> {{-- Added is-centered to center the columns if there are fewer than 3 --}}
                {{-- Pending Orders Card --}}
                <div class="column is-one-third">
                    <div class="card has-background-dark">
                        <div class="card-content has-text-centered">
                            <p class="title is-3 has-text-danger">
                                {{ $pendingOrdersCount ?? 0 }} {{-- Display count, default to 0 if not passed --}}
                            </p>
                            <p class="heading has-text-white">Pending Orders</p>
                            <br>
                            <a href="{{ route('staff.orders.index', ['status' => 'pending']) }}"
                                class="button is-danger is-outlined">View Pending</a> {{-- Link to orders list filtered by status --}}
                        </div>
                    </div>
                </div>

                {{-- Preparing Orders Card --}}
                <div class="column is-one-third">
                    <div class="card has-background-dark">
                        <div class="card-content has-text-centered">
                            <p class="title is-3 has-text-warning">
                                {{ $preparingOrdersCount ?? 0 }} {{-- Display count, default to 0 if not passed --}}
                            </p>
                            <p class="heading has-text-white">Cooking Orders</p>
                            <br>
                            <a href="{{ route('staff.orders.index', ['status' => 'preparing']) }}"
                                class="button is-warning is-outlined">View Cooking</a> {{-- Link to orders list filtered by status --}}
                        </div>
                    </div>
                </div>

                {{-- Completed Orders Card --}}
                <div class="column is-one-third">
                    <div class="card has-background-dark">
                        <div class="card-content has-text-centered">
                            <p class="title is-3 has-text-success">
                                {{ $completedOrdersCount ?? 0 }} {{-- Display count, default to 0 if not passed --}}
                            </p>
                            <p class="heading has-text-white">Completed Orders</p>
                            <br>
                            <a href="{{ route('staff.orders.index', ['status' => 'completed']) }}"
                                class="button is-success is-outlined">View Completed</a> {{-- Link to orders list filtered by status --}}
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>
@endsection

{{-- Optional: Push specific styles or scripts for the dashboard page --}}
@push('styles')
@endpush

@push('scripts')
@endpush
