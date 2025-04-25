@extends('admin.layout.index')

@section('title', 'View User: ' . $user->phone) {{-- Using phone for title --}}

@section('content')
    <div class="container is-fluid">

        <h1 class="title is-4">View User Details</h1>

        <div class="box">
            <div class="columns">
                {{-- Removed Image Column --}}
                {{-- <div class="column is-one-third">
                    <figure class="image is-square">
                        @if ($user->image_path)
                            <img src="{{ asset($user->image_path) }}" alt="{{ $user->name }}">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" alt="No Image Placeholder">
                        @endif
                    </figure>
                    <div class="buttons mt-4">
                        <a href="{{ route('admin.products.edit', $user) }}" class="button is-warning">
                            <span class="icon"><i class="fas fa-edit"></i></span>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this product: {{ $user->name }}?');"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger">
                                <span class="icon"><i class="fas fa-trash"></i></span>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div> --}}

                {{-- User Details Column - Adjusted to take full width --}}
                <div class="column">
                    {{-- User Details --}}
                    {{-- Changed title to show phone number --}}
                    <h2 class="title is-5">User: {{ $user->phone }}</h2>
                    <p><strong>ID:</strong> {{ $user->id }}</p>
                    {{-- Removed Slug, Category, Price, Inventory --}}
                    {{-- <p><strong>Slug:</strong> {{ $user->slug }}</p> --}}
                    {{-- <p><strong>Category:</strong> {{ $user->category->name ?? 'N/A' }}</p> --}}
                    {{-- <p><strong>Price:</strong> {{ number_format($user->price, 2) . ' $' }}</p> --}}
                    {{-- <p><strong>Inventory:</strong> {{ $user->inventory }}</p> --}}


                    {{-- Removed Description and Ingredients Sections --}}
                    {{-- <div class="content mt-4">
                        <p><strong>Description:</strong></p>
                        @if ($user->description)
                            <p>{{ $user->description }}</p>
                        @else
                            <p class="has-text-grey-light">No description provided.</p>
                        @endif
                    </div>

                    <div class="content mt-4">
                        <p><strong>Ingredients:</strong></p>
                        @if ($user->ingredients)
                            <p>{{ $user->ingredients }}</p>
                        @else
                            <p class="has-text-grey-light">No ingredients listed.</p>
                        @endif
                    </div> --}}

                    {{-- Action Buttons (Edit/Delete) - Moved here --}}
                    <div class="buttons mt-4">
                        {{-- Updated routes --}}
                        <a href="{{ route('admin.users.edit', $user) }}" class="button is-warning">
                            <span class="icon"><i class="fas fa-edit"></i></span>
                            <span>Edit</span>
                        </a>
                        {{-- Updated form route and confirmation message --}}
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this user (Phone: {{ $user->phone }})?');"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-danger">
                                <span class="icon"><i class="fas fa-trash"></i></span>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>


                    {{-- Display Timestamps --}}
                    <p class="is-size-7 has-text-grey mt-4">Created: {{ $user->created_at->format('Y-m-d H:i') }}</p>
                    <p class="is-size-7 has-text-grey">Last Updated: {{ $user->updated_at->format('Y-m-d H:i') }}</p>

                </div>
            </div>
        </div>

        {{-- Link back to index at the bottom --}}
        <div class="mt-4">
            {{-- Updated route --}}
            <a href="{{ route('admin.users.index') }}" class="button is-light">
                <span class="icon is-small"><i class="fas fa-arrow-left"></i></span>
                <span>Back to Users</span>
            </a>
        </div>


    </div>
@endsection
