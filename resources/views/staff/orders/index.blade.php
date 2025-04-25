{{-- views/staff/orders/index.blade.php --}}

@extends('staff.layout.index')

@section('title', 'Orders')

@section('content')
    <section class="section">
        <div class="container">

            {{-- Status Filter Tabs --}}
            <div class="tabs is-boxed is-centered">
                <ul>
                    {{-- Link to Pending Orders --}}
                    <li class="{{ $statusFilter == 'pending' ? 'is-active' : '' }}">
                        <a href="{{ route('staff.orders.index', ['status' => 'pending']) }}">
                            <span class="has-text-danger">Pending</span>
                        </a>
                    </li>
                    {{-- Link to Cooking Orders --}}
                    <li class="{{ $statusFilter == 'cooking' ? 'is-active' : '' }}">
                        <a href="{{ route('staff.orders.index', ['status' => 'cooking']) }}">
                            <span class="has-text-warning">Cooking</span>
                        </a>
                    </li>
                    {{-- Link to Completed Orders --}}
                    <li class="{{ $statusFilter == 'completed' ? 'is-active' : '' }}">
                        <a href="{{ route('staff.orders.index', ['status' => 'completed']) }}">
                            <span class="has-text-success">Completed</span>
                        </a>
                    </li>
                    {{-- Link to Canceled Orders --}}
                    <li class="{{ $statusFilter == 'canceled' ? 'is-active' : '' }}">
                        <a href="{{ route('staff.orders.index', ['status' => 'canceled']) }}">
                            <span class="has-text-grey">Canceled</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Orders Table --}}
            <div class="table-container">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    {{ $order->user->name ?? ($order->user->phone ?? 'N/A') }}
                                </td>
                                <td>{{ number_format($order->total_amount, 2) . ' $' }}</td>
                                <td>
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
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    {{-- Action Buttons --}}
                                    <div class="buttons are-small">
                                        <a href="{{ route('staff.orders.show', $order) }}"
                                            class="button is-info is-outlined">View</a>

                                        @if ($order->status === 'pending')
                                            {{-- Accept Button (for pending orders) --}}
                                            <form action="{{ route('staff.orders.accept', $order) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="button is-success is-outlined">Accept</button>
                                            </form>

                                            {{-- Deny Button (for pending orders) --}}
                                            <form action="{{ route('staff.orders.deny', $order) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="button is-danger is-outlined">Deny</button>
                                            </form>
                                        @endif

                                        {{-- Add other status-specific action buttons here (e.g., "Mark as Completed" for cooking orders) --}}
                                        @if ($order->status === 'cooking')
                                            <form action="{{ route('staff.orders.complete', $order) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit"
                                                    class="button is-success is-outlined">Complete</button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="has-text-centered">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links (if using paginate) --}}
            @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $orders->links('pagination::default') }}
            @endif

        </div>
    </section>
@endsection

@push('styles')
    {{-- Page-specific styles here --}}
@endpush

@push('scripts')
    {{-- Page-specific scripts here --}}
@endpush
