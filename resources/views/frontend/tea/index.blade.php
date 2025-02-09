@extends('frontend.master')

@section('title', 'Ready to experience the magic of tea?')

@section('content')
    <br>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                    <aside class="menu">
                        <p class="menu-label">Tea</p>
                        <ul class="menu-list">
                            <li><a href="#hot-teas" id="hot-tea-link">Hot Tea</a></li>
                            <li><a href="#iced-teas" id="iced-tea-link">Iced Tea</a></li>
                        </ul>
                        <p class="menu-label">Coffees</p>
                        <ul class="menu-list">
                            <li><a href="/coffee#hot-coffees" id="hot-coffees-link">Hot Coffee</a></li>
                            <li><a href="/coffee#cold-coffees" id="cold-coffees-link">Iced Coffee</a></li>
                            <li><a href="/coffee#frappe-coffees" id="frappe-coffees-link">Frappe Coffee</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column">
                    <section id="hot-teas">
                        <div class="has-text-centered">
                            <h1 class="title">Hot Teas</h1>
                            <br>
                        </div>
                        <div class="columns is-multiline">
                            @foreach ($hotTeas as $tea)
                                <div class="column is-3">
                                    <div class="card">
                                        <a href="{{ route('viewItem.index', $tea->slug) }}">
                                            <div class="card-image">
                                                <figure class="image is-4by5">
                                                    <img href="{{ route('viewItem.index', $tea->slug) }}"
                                                        src="{{ asset($tea->image_path) }}" alt="{{ $tea->name }}">
                                                </figure>
                                            </div>
                                        </a>
                                        <div class="card-content">
                                            <div class="media">
                                                <div class="media-content">
                                                    <p class="title is-4">{{ $tea->name }}</p>
                                                </div>
                                            </div>
                                            <div class="columns is-mobile">
                                                <div class="column is-6">
                                                    <small
                                                        class="has-text-warning has-text-weight-bold">{{ $tea->price }}$</small>
                                                </div>
                                                <div class="column is-6 has-text-right">
                                                    <button class="button is-primary is-small has-text-weight-bold">Order
                                                        Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section id="iced-teas">
                        <div class="has-text-centered">
                            <br>
                            <br>
                            <h1 class="title">Iced Teas</h1>
                            <br>
                        </div>
                        <div class="columns is-multiline">
                            @foreach ($icedTeas as $tea)
                                <div class="column is-3">
                                    <div class="card">
                                        <div class="card-image">
                                            <figure class="image is-4by5">
                                                <img href="{{ route('viewItem.index', $tea->slug) }}"
                                                    src="{{ asset($tea->image_path) }}" alt="{{ $tea->name }}">
                                            </figure>
                                        </div>
                                        <div class="card-content">
                                            <div class="media">
                                                <div class="media-content">
                                                    <p class="title is-4">{{ $tea->name }}</p>
                                                </div>
                                            </div>
                                            <div class="columns is-mobile">
                                                <div class="column is-6">
                                                    <small
                                                        class="has-text-warning has-text-weight-bold">{{ $tea->price }}$</small>
                                                </div>
                                                <div class="column is-6 has-text-right">
                                                    <button class="button is-primary is-small has-text-weight-bold">Order
                                                        Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hotTeaLink = document.getElementById('hot-tea-link');
            const icedTeaLink = document.getElementById('iced-tea-link');
            const hotTeasSection = document.getElementById('hot-teas');
            const icedTeasSection = document.getElementById('iced-teas');

            function highlightLink(link) {
                // Remove active class from other links
                document.querySelectorAll('.menu-list a').forEach(a => a.classList.remove('is-active',
                    'is-primary')); // Remove is-primary too
                link.classList.add('is-active', 'is-primary'); // Add is-primary
            }

            function checkActiveSection() {
                const hotTeasTop = hotTeasSection.offsetTop;
                const icedTeasTop = icedTeasSection.offsetTop;
                const scrollPosition = window.scrollY;

                if (scrollPosition >= icedTeasTop - 100) {
                    highlightLink(icedTeaLink);
                } else {
                    highlightLink(hotTeaLink);
                }
            }

            window.addEventListener('scroll', checkActiveSection);
            window.addEventListener('load', checkActiveSection); // Call on page load too
        });
    </script>
@endsection
