{{-- resources/views/frontend/cart/index.blade.php --}}

@extends('frontend.master')

@section('title', 'Your Cart')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Your Cart</h1>

            {{-- ... (Success and Error Notifications) ... --}}

            @if (empty($cart))
                <p>Your cart is empty.</p>
                <a href="{{ url('/') }}" class="button is-primary">Continue Shopping</a>
            @else
                <table class="table is-striped is-fullwidth" id="cart-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cartTotal = 0;
                        @endphp
                        @foreach ($cart as $cartItemId => $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $cartTotal += $subtotal;
                            @endphp
                            <tr data-item-id="{{ $cartItemId }}">
                                <td>
                                    {{ $item['name'] }}
                                    {{-- Display options here if applicable --}}
                                </td>
                                <td class="item-price">{{ $item['price'] }}$</td>
                                <td>
                                    {{-- You'll add a form/AJAX here for quantity updates later --}}
                                    <input type="number" value="{{ $item['quantity'] }}" min="1"
                                        style="width: 60px;">
                                </td>
                                <td class="item-subtotal">{{ $subtotal }}$</td>
                                <td>
                                    {{-- Remove Item Form --}}
                                    <form action="{{ route('cart.remove', ['cartItemId' => $cartItemId]) }}" method="POST"
                                        style="display: inline-block;"> {{-- Use inline-block to keep button in table cell --}}
                                        @csrf
                                        @method('DELETE') {{-- Spoof DELETE request --}}
                                        <button type="submit" class="button is-danger is-small">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="has-text-right"><strong>Total:</strong></td>
                            <td id="cart-total">@php
                                $cartTotal = 0;
                                foreach ($cart as $item) {
                                    $cartTotal += $item['price'] * $item['quantity'];
                                }
                                echo $cartTotal . '$';
                            @endphp</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="has-text-right">
                    {{-- "Place Order" Button Form --}}
                    <form method="POST" action="{{ route('order.place') }}">
                        @csrf
                        <button type="submit" class="button is-success is-large">Place Order</button>
                    </form>
                </div>

            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartTable = document.getElementById('cart-table');

            if (cartTable) {
                cartTable.addEventListener('input', function(event) {
                    if (event.target.classList.contains('quantity-input')) {
                        handleQuantityChange(event.target);
                    }
                });

                // You'll add event listeners for remove buttons later if you implement removal with AJAX
                // For now, the form submission handles removal
            }

            function handleQuantityChange(inputElement) {
                const row = inputElement.closest('tr');
                const priceElement = row.querySelector('.item-price');
                const subtotalElement = row.querySelector('.item-subtotal');
                let quantity = parseInt(inputElement.value);
                const price = parseFloat(priceElement.textContent);

                if (quantity < 1 || isNaN(quantity)) {
                    inputElement.value = 1;
                    quantity = 1;
                }

                const subtotal = price * quantity;
                subtotalElement.textContent = subtotal.toFixed(2) + '$';

                updateCartTotal();
            }

            function updateCartTotal() {
                const subtotalElements = cartTable.querySelectorAll('.item-subtotal');
                let grandTotal = 0;

                subtotalElements.forEach(function(element) {
                    const subtotalText = element.textContent;
                    const subtotal = parseFloat(subtotalText.replace('$', ''));
                    grandTotal += subtotal;
                });

                const cartTotalElement = document.getElementById('cart-total');
                cartTotalElement.textContent = grandTotal.toFixed(2) + '$';
            }

            // You'll add handleRemoveItem function later if using AJAX
        });
    </script>
@endsection
