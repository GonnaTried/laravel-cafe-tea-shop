{{-- resources/views/frontend/order/_order_card.blade.php --}}

<div class="box mb-4"> {{-- Use Bulma box component --}}
    <article class="media">
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>Order #{{ $order->id }}</strong>
                    <small>Placed on: {{ $order->created_at->format('F d, Y H:i') }}</small> {{-- Format the date --}}
                    <br>
                    Status: <span
                        class="tag is-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'info') }}">
                        {{ ucfirst($order->status) }} {{-- Capitalize the first letter --}}
                    </span>
                    <br>
                    Total: <strong>{{ $order->total_amount }}$</strong> {{-- Or ${ { $order->total_amount }} --}}
                </p>
                <h6 class="title is-6">Items:</h6>
                <ul>
                    @foreach ($order->orderItems as $item)
                        <li>
                            {{ $item->quantity }} x {{ $item->menuItem->name }} ({{ $item->price }}$ each)
                            {{-- Display options if applicable --}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- Optional: Add a link to view full order details --}}
        {{-- <div class="media-right">
            <a href="{{ route('order.confirmation', ['order' => $order->id]) }}" class="button is-small is-primary">View Details</a>
        </div> --}}
    </article>
</div>
