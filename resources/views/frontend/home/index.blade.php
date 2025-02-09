@extends('frontend.master')

@section('title', 'Welcome')

@section('content')
    <section class="section">
        <div class="container">
            <h1 class="title">Featured Hot Coffee</h1>
            <div class="columns is-multiline">
                @foreach ($menuItems as $menuItem)
                    <div class="column is-3">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by5">
                                    <img src="{{ asset($menuItem->image_path) }}" alt="{{ $menuItem->name }}">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">{{ $menuItem->name }}</p>
                                    </div>
                                </div>
                                <div class="content">
                                    <h6 class="has-text-warning">
                                        {{ $menuItem->price }}$</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="has-text-centered">
                <br>
                <h1 class="title">Our Shop Enviroment</h1>
                <br>
            </div>
            <figure class="image is-16by9">
                <img src="images/Cafe-design.png" />
            </figure>
        </div>
    </section>
@endsection
