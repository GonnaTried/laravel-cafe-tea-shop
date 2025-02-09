@extends('frontend.master')

@section('title', $menuItem->name) <!-- Title dynamically set -->

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4"> <!-- Reduced the column size for the image -->
                    <br>
                    <figure class="image is-4by5"> <!-- Adjusted the aspect ratio -->
                        <img src="{{ asset($menuItem->image_path) }}" alt="{{ $menuItem->name }}">
                    </figure>
                </div>
                <div class="column is-8"> <!-- Increased the column size for the text -->
                    <br>
                    <h1 class="title is-4">{{ $menuItem->name }}</h1> <!-- Reduced the title size -->
                    <h2 class="subtitle is-6 has-text-warning">Price: ${{ $menuItem->price }}</h2>
                    <p class="is-size-5"><strong>Description:</strong> {{ $menuItem->description }}</p>
                    <br>
                    <p class="is-size-5"><strong>Ingredients:</strong> {{ $menuItem->ingredients }}</p>
                </div>
            </div>
            <div class="has-text-centered">
                <button class="button is-primary">Order Now</button> <!-- Optional Order Button -->
            </div>
        </div>
    </section>
@endsection
