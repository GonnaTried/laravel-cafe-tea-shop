@extends('frontend.master')

@section('title', 'Welcome')

@section('content')
    <section class="section">
        <div class="container">

            {{-- Section for Featured Hot Tea --}}
            @if ($hot_tea->count() > 0)
                <h1 class="title">Featured Hot Tea</h1>
                <div class="columns is-multiline">
                    @foreach ($hot_tea as $menuItem)
                        <div class="column is-3">
                            <div class="card">
                                <a href="{{ route('viewItem.index', ['slug' => $menuItem->slug]) }}">
                                    <div class="card-image">
                                        <figure class="image is-4by5">
                                            <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}">
                                        </figure>
                                    </div>
                                </a>
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
            @endif

            {{-- Section for Featured Iced Tea --}}
            @if ($iced_tea->count() > 0)
                <h1 class="title">Featured Iced Tea</h1>
                <div class="columns is-multiline">
                    @foreach ($iced_tea as $menuItem)
                        <div class="column is-3">
                            <div class="card">
                                <a href="{{ route('viewItem.index', ['slug' => $menuItem->slug]) }}">
                                    <div class="card-image">
                                        <figure class="image is-4by5">
                                            <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}">
                                        </figure>
                                    </div>
                                </a>
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
            @endif

            {{-- Section for Featured Hot Coffee --}}
            @if ($hot_coffee->count() > 0)
                <h1 class="title">Featured Hot Coffee</h1>
                <div class="columns is-multiline">
                    @foreach ($hot_coffee as $menuItem)
                        <div class="column is-3">
                            <div class="card">
                                <a href="{{ route('viewItem.index', ['slug' => $menuItem->slug]) }}">
                                    <div class="card-image">
                                        <figure class="image is-4by5">
                                            <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}">
                                        </figure>
                                    </div>
                                </a>
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
            @endif



            {{-- Section for Featured Iced Coffee --}}
            @if ($iced_coffee->count() > 0)
                <h1 class="title">Featured Iced Coffee</h1>
                <div class="columns is-multiline">
                    @foreach ($iced_coffee as $menuItem)
                        <div class="column is-3">
                            <div class="card">
                                <a href="{{ route('viewItem.index', ['slug' => $menuItem->slug]) }}">
                                    <div class="card-image">
                                        <figure class="image is-4by5">
                                            <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}">
                                        </figure>
                                    </div>
                                </a>
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
            @endif

            {{-- Section for Featured Frappe Coffee --}}
            @if ($frappe_coffee->count() > 0)
                <h1 class="title">Featured Frappe Coffee</h1>
                <div class="columns is-multiline">
                    @foreach ($frappe_coffee as $menuItem)
                        <div class="column is-3">
                            <div class="card">
                                <a href="{{ route('viewItem.index', ['slug' => $menuItem->slug]) }}">
                                    <div class="card-image">
                                        <figure class="image is-4by5">
                                            <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}">
                                        </figure>
                                    </div>
                                </a>
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
            @endif


            <div class="has-text-centered">
                <br>
                <h1 class="title">Our Shop Enviroment</h1>
                <br>
            </div>
            <figure class="image is-16by9">
                <img src="{{ asset('images/Cafe-design.png') }}" />
            </figure>
        </div>
    </section>
@endsection
