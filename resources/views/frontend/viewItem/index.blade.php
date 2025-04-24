@extends('frontend.master')

@section('title', $menuItem->name)

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half">
                    <figure class="image is-4by5">
                        <img src="{{ asset($menuItem->image_path) }}" alt="{{ $menuItem->name }}">
                    </figure>
                </div>
                <div class="column is-half">
                    <h1 class="title">{{ $menuItem->name }}</h1>
                    <h2 class="subtitle has-text-warning">{{ $menuItem->price }}$</h2>
                    <br>

                    @if ($menuItem->description)
                        <h3 class="title is-5">Description</h3>
                        <p>{{ $menuItem->description }}</p>
                        <br>
                    @endif

                    @if ($menuItem->ingredients)
                        <h3 class="title is-5">Ingredients</h3>
                        <p>{{ $menuItem->ingredients }}</p>
                        <br>
                    @endif

                    @if ($menuItem->itemOptions->count() > 0)
                        <strong>Available Options:</strong>
                        <ul>
                            @foreach ($menuItem->itemOptions as $option)
                                <li>{{ $option->name }}</li>
                            @endforeach
                        </ul>
                        <br>
                    @endif

                    <br>

                    {{-- Add to Cart Form --}}
                    {{-- Action will point to a cart controller method --}}
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="menu_item_id" value="{{ $menuItem->id }}">

                        <div class="field">
                            <label class="label">Quantity</label>
                            <div class="control">
                                <input class="input" type="number" name="quantity" value="1" min="1">
                            </div>
                            @error('quantity')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-primary">Add to Cart</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
