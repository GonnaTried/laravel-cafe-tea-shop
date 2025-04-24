{{-- resources/views/frontend/order/history.blade.php --}}

@extends('frontend.master')

@section('title', 'Order History')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Your Order History</h1>

            {{-- Display Completed Orders --}}
            @if ($completedOrders->count() > 0)
                <h2 class="subtitle">Completed Orders</h2>
                @foreach ($completedOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order]) {{-- Use a partial view for order details --}}
                @endforeach
            @endif

            {{-- Display Preparing Orders --}}
            @if ($preparingOrders->count() > 0)
                <h2 class="subtitle">Preparing Orders</h2>
                @foreach ($preparingOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif

            {{-- Display Pending Orders --}}
            @if ($pendingOrders->count() > 0)
                <h2 class="subtitle">Pending Orders</h2>
                @foreach ($pendingOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif

            {{-- Display Cancelled Orders --}}
            @if ($cancelledOrders->count() > 0)
                <h2 class="subtitle">Cancelled Orders</h2>
                @foreach ($cancelledOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif

            {{-- Message if no orders found --}}
            @if (
                $completedOrders->isEmpty() &&
                    $preparingOrders->isEmpty() &&
                    $cancelledOrders->isEmpty() &&
                    $pendingOrders->isEmpty())
                <p>You have no order history yet.</p>
                <a href="{{ url('/') }}" class="button is-primary">Start Shopping</a>
            @endif

        </div>
    </section>
@endsection

{{-- No specific scripts are typically needed for displaying history --}}
{{-- @section('scripts') @endsection --}}
