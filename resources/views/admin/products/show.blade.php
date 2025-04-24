@extends('admin.layout.index')

@section('title', 'View Product: ' . $product->name)

@section('content')
    <div class="container is-fluid">

        <h1 class="title is-4">View Product Details</h1>

        <div class="box">
            <div class="columns">
                <div class="column is-one-third">
                    {{-- Product Image --}}
                    <figure class="image is-square">
                        @if ($product->image_path)
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" alt="No Image Placeholder">
                        @endif
                    </figure>
                    {{-- Action Buttons (Edit/Delete) --}}
                    <div class="buttons mt-4">
                        <a href="{{ route('admin.products.edit', $product) }}" class="button is-warning">
                            <span class="icon"><i class="fas fa-edit"></i></span>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this product: {{ $product->name }}?');"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger">
                                <span class="icon"><i class="fas fa-trash"></i></span>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="column">
                    {{-- Product Details --}}
                    <h2 class="title is-5">{{ $product->name }}</h2>
                    <p><strong>ID:</strong> {{ $product->id }}</p>
                    <p><strong>Slug:</strong> {{ $product->slug }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                    <p><strong>Price:</strong> {{ number_format($product->price, 2) . ' $' }}</p>
                    <p><strong>Inventory:</strong> {{ $product->inventory }}</p>


                    <div class="content mt-4">
                        <p><strong>Description:</strong></p>
                        @if ($product->description)
                            <p>{{ $product->description }}</p>
                        @else
                            <p class="has-text-grey-light">No description provided.</p>
                        @endif
                    </div>

                    <div class="content mt-4">
                        <p><strong>Ingredients:</strong></p>
                        @if ($product->ingredients)
                            <p>{{ $product->ingredients }}</p>
                        @else
                            <p class="has-text-grey-light">No ingredients listed.</p>
                        @endif
                    </div>

                    <p class="is-size-7 has-text-grey mt-4">Created: {{ $product->created_at->format('Y-m-d H:i') }}</p>
                    <p class="is-size-7 has-text-grey">Last Updated: {{ $product->updated_at->format('Y-m-d H:i') }}</p>

                </div>
            </div>
        </div>

        {{-- Link back to index at the bottom --}}
        <div class="mt-4">
            <a href="{{ route('admin.products.index') }}" class="button is-light">
                <span class="icon is-small"><i class="fas fa-arrow-left"></i></span>
                <span>Back to Products</span>
            </a>
        </div>


    </div>
@endsection
