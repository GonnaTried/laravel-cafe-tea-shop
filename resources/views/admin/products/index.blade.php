{{-- resources/views/admin/products/index.blade.php - Card UI with Inventory (Using Accessor) --}}

@extends('admin.layout.index') {{-- Assuming you have a main admin layout --}}

@section('content')
    <div class="container is-fluid">

        <h1 class="title is-4">Product Management</h1>

        {{-- Success/Error Message Display --}}
        @if (session('success'))
            <div class="notification is-success is-light">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="notification is-danger is-light">
                {{ session('error') }}
            </div>
        @endif
        <br>
        {{-- Add New Product Button and Product Count --}}
        <div class="columns is-mobile is-justify-content-space-between is-align-items-center mb-4">
            <div class="column is-narrow">
                {{-- Optional: Maybe a product count? --}}
                <p class="is-size-6 has-text-grey">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of
                    {{ $products->total() }} products</p> {{-- Changed has-text-white to has-text-grey for better contrast --}}
            </div>
            <div class="column is-narrow">
                <a href="{{ route('admin.products.create') }}" class="button is-primary is-normal">
                    <span class="icon is-small">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span>Add New Product</span> {{-- Changed <strong> to <span> --}}
                </a>
            </div>
        </div>

        {{-- Products List (Card-like structure) --}}
        <div class="box">
            @forelse ($products as $product)
                <article class="media is-align-items-center py-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                    {{-- Add a bottom border except for the last item --}}
                    <figure class="media-left">
                        <p class="image is-64x64">
                            {{-- *** Using the getImageUrlAttribute() accessor here *** --}}
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ $product->name }}</strong>
                                {{-- Removed Type display --}}
                                <small class="ml-2 has-text-primary">{{ $product->category->name ?? 'N/A' }}</small>
                                <br>
                                {{ Str::limit($product->description, 100) }} {{-- Limit description length --}}
                            </p>
                        </div>
                    </div>
                    <div class="media-right">
                        <div class="buttons are-small">
                            {{-- Optional View Button --}}
                            {{-- If you don't have a show view, remove this link --}}
                            <a href="{{ route('admin.products.show', $product) }}" class="button is-info is-light"
                                title="View Details">
                                <span class="icon"><i class="fas fa-eye"></i></span>

                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="button is-warning is-light"
                                title="Edit">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this product: {{ $product->name }}?');"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-danger is-light" title="Delete">
                                    <span class="icon"><i class="fas fa-trash"></i></span>
                                </button>
                            </form>
                        </div>
                        <p class="is-size-7 has-text-warning mt-2">
                            Price: {{ number_format($product->price, 2) . ' $' }} |
                            Inventory: {{ $product->inventory }} {{-- Display Inventory --}}
                            {{-- Removed Status display --}}
                        </p>
                    </div>
                </article>
                {{-- Add a horizontal rule or border between items visually --}}
            @empty
                <div class="content has-text-centered">
                    <p>No products found.</p>
                </div>
            @endforelse
        </div>
        {{-- Pagination Links --}}
        <div class="mt-4">
            {{-- Use 'default' if you styled the default theme, or 'pagination::bulma' if you found a Bulma theme --}}
            {{ $products->links('pagination::default') }}
        </div>

    </div>
    <br>

    {{-- Basic custom CSS for the border --}}
    <style>
        .border-bottom {
            border-bottom: 1px solid #dbdbdb;
        }
    </style>
@endsection
