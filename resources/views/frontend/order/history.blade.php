{{-- resources/views/frontend/order/history.blade.php --}}

@extends('frontend.master')

@section('title', 'Order History')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Your Order History</h1>
            <br>

            {{-- Status Filter Tabs --}}
            {{-- Get the current status filter from the URL query string, default to 'all' --}}
            @php
                $statusFilter = request()->query('status', 'all');
            @endphp

            <div class="tabs is-boxed is-centered">
                <ul>
                    {{-- Link to All Orders --}}
                    <li class="{{ $statusFilter == 'all' ? 'is-active' : '' }}">
                        <a href="{{ route('order.history', ['status' => 'all']) }}">
                            <span>All Orders</span>
                        </a>
                    </li>
                    {{-- Link to Pending Orders --}}
                    <li class="{{ $statusFilter == 'pending' ? 'is-active' : '' }}">
                        <a href="{{ route('order.history', ['status' => 'pending']) }}">
                            <span class="has-text-danger">Pending</span>
                        </a>
                    </li>
                    {{-- Link to Cooking Orders --}}
                    <li class="{{ $statusFilter == 'cooking' ? 'is-active' : '' }}">
                        <a href="{{ route('order.history', ['status' => 'cooking']) }}">
                            <span class="has-text-info">Cooking</span> {{-- Using info for consistency --}}
                        </a>
                    </li>
                    {{-- Link to Completed Orders --}}
                    <li class="{{ $statusFilter == 'completed' ? 'is-active' : '' }}">
                        <a href="{{ route('order.history', ['status' => 'completed']) }}">
                            <span class="has-text-success">Completed</span>
                        </a>
                    </li>
                    {{-- Link to Cancelled Orders --}}
                    <li class="{{ $statusFilter == 'cancelled' ? 'is-active' : '' }}">
                        <a href="{{ route('order.history', ['status' => 'cancelled']) }}">
                            <span class="has-text-danger">Cancelled</span> {{-- Using danger for cancelled --}}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Conditional Display based on Status Filter --}}

            {{-- Check if there are any orders retrieved at all for the current filter --}}
            {{-- You'll need to pass a single collection of filtered orders from the controller --}}

            {{-- Placeholder: You'll replace this with a loop through a single $orders collection --}}
            @if ($orders->count() > 0)
                @foreach ($orders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @else
                {{-- Message if no orders found for the *current* filter --}}
                <p>No orders found with the status: <strong>{{ ucfirst($statusFilter) }}</strong>.</p>
                {{-- Offer to view all orders if a specific filter is applied --}}
                @if ($statusFilter !== 'all')
                    <p><a href="{{ route('order.history', ['status' => 'all']) }}" class="button is-link is-outlined">View
                            All Orders</a></p>
                @else
                    {{-- This is the case when 'all' is selected and there are no orders at all --}}
                    <p>You have no order history yet.</p>
                    <a href="{{ url('/') }}" class="button is-primary">Start Shopping</a>
                @endif

            @endif




        </div>
    </section>
@endsection

{{-- No specific scripts are typically needed for displaying history --}}
{{-- @section('scripts') @endsection --}}
