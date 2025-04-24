{{-- resources/views/frontend/order/confirmation.blade.php --}}

@extends('frontend.master')

@section('title', 'Order Confirmation')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Order Confirmation</h1>

            @if (session('success'))
                <div class="notification is-success">
                    {{ session('success') }}
                </div>
            @endif

            <p>Thank you for your order! Your order number is: <strong>{{ $order->id }}</strong></p>
            <p><strong>You can pick up your order at our store location.</strong></p>

            <p>Estimated preparation time: <strong>{{ $estimatedPreparationTime }} minutes</strong>.</p>

            <p>Total Amount: <strong>{{ $order->total_amount }}$</strong></p>
            <p>Status: <strong>{{ $order->status }}</strong></p>

            <h2 class="subtitle">Order Items:</h2>
            <ul>
                @foreach ($order->orderItems as $item)
                    <li>
                        {{ $item->quantity }} x {{ $item->menuItem->name }} ({{ $item->price }}$ each)
                    </li>
                @endforeach
            </ul>

            <br>
            <a href="{{ url('/') }}" class="button is-primary">Continue Shopping</a>

        </div>
    </section>
@endsection
