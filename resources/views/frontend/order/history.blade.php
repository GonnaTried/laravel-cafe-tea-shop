{{-- resources/views/frontend/order/history.blade.php --}}

@extends('frontend.master')

@section('title', 'Order History')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Your Order History</h1>
            <br>
            {{-- Display Pending Orders --}}
            @if ($pendingOrders->count() > 0)
                <h2 class="subtitle has-text-primary">Pending Orders</h2>
                @foreach ($pendingOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif

            {{-- Display Cooking Orders --}}
            @if ($cookingOrders->count() > 0)
                <h2 class="subtitle has-text-info">Cooking Orders</h2>
                @foreach ($cookingOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif



            {{-- Display Completed Orders (Typically shown last) --}}
            @if ($completedOrders->count() > 0)
                <h2 class="subtitle has-text-success">Completed Orders</h2>
                @foreach ($completedOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif

            {{-- Display Cancelled Orders (Might be useful to show before completed) --}}
            @if ($cancelledOrders->count() > 0)
                <h2 class="subtitle has-text-danger">Cancelled Orders</h2>
                @foreach ($cancelledOrders as $order)
                    @include('frontend.order._order_card', ['order' => $order])
                @endforeach
            @endif


            {{-- Message if no orders found --}}
            @if (
                $completedOrders->isEmpty() &&
                    $cookingOrders->isEmpty() &&
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
