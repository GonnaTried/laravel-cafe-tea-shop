{{-- views/staff/orders/show.blade.php --}}

@extends('staff.layout.index')

@section('title', 'Order #' . $order->id)

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Order Details: #{{ $order->id }}</h1>

            {{-- Back Button --}}
            <div class="mb-4">
                <a href="{{ route('staff.orders.index', ['status' => $order->status]) }}"
                    class="button is-info is-outlined is-small">
                    « Back to Orders
                </a>
            </div>


            <div class="columns is-multiline">
                {{-- Order Information Column --}}
                <div class="column is-half">
                    <div class="box has-background-dark has-text-light">
                        <h2 class="title is-5 has-text-light">Order Information</h2>
                        <p><strong>Status:</strong>
                            <span
                                class="tag is-{{ $order->status == 'pending'
                                    ? 'danger'
                                    : ($order->status == 'cooking'
                                        ? 'warning'
                                        : ($order->status == 'completed'
                                            ? 'success'
                                            : ($order->status == 'canceled'
                                                ? 'grey'
                                                : 'light'))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>Total Amount:</strong> {{ number_format($order->total_amount, 2) . ' $' }}</p>
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                        <p><strong>Last Updated:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}</p>
                        {{-- Add more order details here if available (e.g., payment method, notes) --}}
                    </div>
                </div>

                {{-- Customer Information Column --}}
                <div class="column is-half">
                    <div class="box has-background-dark has-text-light">
                        <h2 class="title is-5 has-text-light">Customer Information</h2>
                        @if ($order->user)
                            <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                            {{-- Add more user details if available (e.g., email, address) --}}
                        @else
                            <p>Customer information not available.</p>
                        @endif
                    </div>
                </div>

                {{-- Order Items Column --}}
                <div class="column is-full">
                    <div class="box has-background-dark has-text-light">
                        <h2 class="title is-5 has-text-light">Order Items</h2>
                        @if ($order->orderItems->count() > 0)
                            <table class="table is-striped is-hoverable is-fullwidth is-narrow is-dark">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->menuItem->name ?? 'Deleted Item' }}</td>

                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->price, 2) }}</td>
                                            <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No items found for this order.</p>
                        @endif
                    </div>
                </div>

                {{-- Status Update Form --}}
                <div class="column is-full">
                    <div class="box has-background-dark has-text-light">
                        <h2 class="title is-5 has-text-light">Update Status</h2>
                        <div class="buttons"> {{-- Wrap buttons in a Bulma buttons div --}}

                            @if ($order->status === 'pending')
                                {{-- Accept Button (for pending orders) --}}
                                <form action="{{ route('staff.orders.accept', $order) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button is-success is-outlined">Accept</button>
                                </form>

                                {{-- Deny Button (for pending orders) --}}
                                <form action="{{ route('staff.orders.deny', $order) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button is-danger is-outlined">Deny</button>
                                </form>
                            @elseif ($order->status === 'cooking')
                                {{-- Mark as Completed Button (for cooking orders) --}}
                                <form action="{{ route('staff.orders.complete', $order) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button is-success">Mark as Completed</button>
                                </form>
                            @else
                                <p class="has-text-grey">Status cannot be updated from {{ $order->status }}.</p>
                            @endif

                        </div> {{-- End buttons div --}}
                    </div>
                </div>

            </div> {{-- End columns --}}

        </div> {{-- End container --}}
    </section>
@endsection

@push('styles')
    {{-- Page-specific styles here --}}
@endpush

@push('scripts')
    {{-- Page-specific scripts here --}}
@endpush
