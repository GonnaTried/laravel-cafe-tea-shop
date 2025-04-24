@extends('frontend.master')

@section('title', 'Fuel for your dreams.')

@section('content')
    <br>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                    <aside class="menu">
                        <p class="menu-label">Tea</p>
                        <ul class="menu-list">
                            <li><a href="/tea#hot-teas" id="hot-tea-link">Hot Tea</a></li>
                            <li><a href="/tea#iced-teas" id="iced-tea-link">Iced Tea</a></li>
                        </ul>
                        <p class="menu-label">Coffees</p>
                        <ul class="menu-list">
                            <li><a href="#hot-coffees" id="hot-coffees-link">Hot Coffee</a></li>
                            <li><a href="#cold-coffees" id="cold-coffees-link">Iced Coffee</a></li>
                            <li><a href="#frappe-coffees" id="frappe-coffees-link">Frappe Coffee</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column">
                    <section id="hot-coffees">
                        <div class="has-text-centered">
                            <h1 class="title">Hot Coffees</h1>
                            <br>
                        </div>
                        <div class="columns is-multiline">
                            @foreach ($hotCoffees as $coffee)
                                <div class="column is-3">
                                    <div class="card">
                                        <a href="{{ route('viewItem.index', $coffee->slug) }}">
                                            <div class="card-image">
                                                <figure class="image is-4by5">
                                                    <img src="{{ asset($coffee->image_path) }}" alt="{{ $coffee->name }}">
                                                </figure>
                                            </div>
                                        </a>
                                        <div class="card-content">
                                            <div class="media">
                                                <div class="media-content">
                                                    <p class="title is-4">{{ $coffee->name }}</p>
                                                </div>
                                            </div>
                                            <div class="columns is-mobile">
                                                <div class="column is-6">
                                                    <h6 class="has-text-warning has-text-weight-bold">
                                                        {{ $coffee->price }}$
                                                    </h6>
                                                </div>
                                                <div class="column is-6 has-text-right">
                                                    {{-- Add to Cart Form --}}
                                                    <form method="POST" action="{{ route('cart.add') }}">
                                                        @csrf
                                                        {{-- Corrected menu_item_id to use $coffee->id --}}
                                                        <input type="hidden" name="menu_item_id"
                                                            value="{{ $coffee->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit"
                                                            class="button is-primary is-small has-text-weight-bold">Add to
                                                            Cart</button> {{-- Changed button text --}}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section id="cold-coffees">
                        <div class="has-text-centered">
                            <br>
                            <br>
                            <h1 class="title">Iced Coffees</h1>
                            <br>
                        </div>
                        <div class="columns is-multiline">
                            @foreach ($coldCoffees as $coffee)
                                <div class="column is-3">
                                    <div class="card">
                                        <a href="{{ route('viewItem.index', $coffee->slug) }}">
                                            <div class="card-image">
                                                <figure class="image is-4by5">
                                                    <img src="{{ asset($coffee->image_path) }}" alt="{{ $coffee->name }}">
                                                </figure>
                                            </div>
                                        </a>
                                        <div class="card-content">
                                            <div class="media">
                                                <div class="media-content">
                                                    <p class="title is-4">{{ $coffee->name }}</p>
                                                </div>
                                            </div>
                                            <div class="columns is-mobile">
                                                <div class="column is-6">
                                                    <h6 class="has-text-warning has-text-weight-bold">{{ $coffee->price }}$
                                                    </h6>
                                                </div>
                                                <div class="column is-6 has-text-right">
                                                    {{-- Add to Cart Form --}}
                                                    <form method="POST" action="{{ route('cart.add') }}">
                                                        @csrf
                                                        <input type="hidden" name="menu_item_id"
                                                            value="{{ $coffee->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit"
                                                            class="button is-primary is-small has-text-weight-bold">Add to
                                                            Cart</button> {{-- Changed button text --}}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <section id="frappe-coffees">
                        <div class="has-text-centered">
                            <br>
                            <br>
                            <h1 class="title">Frappe</h1>
                            <br>
                        </div>
                        <div class="columns is-multiline">
                            @foreach ($frappeCoffees as $coffee)
                                <div class="column is-3">
                                    <div class="card">
                                        <a href="{{ route('viewItem.index', $coffee->slug) }}">
                                            <div class="card-image">
                                                <figure class="image is-4by5">
                                                    <img src="{{ asset($coffee->image_path) }}" alt="{{ $coffee->name }}">
                                                </figure>
                                            </div>
                                        </a>
                                        <div class="card-content">
                                            <div class="media">
                                                <div class="media-content">
                                                    <p class="title is-4">{{ $coffee->name }}</p>
                                                </div>
                                            </div>
                                            <div class="columns is-mobile">
                                                <div class="column is-6">
                                                    <h6 class="title has-text-warning has-text-weight-bold">
                                                        {{-- Corrected class: title to h6 --}}
                                                        {{ $coffee->price }}$</h6>
                                                </div>
                                                <div class="column is-6 has-text-right">
                                                    {{-- Add to Cart Form --}}
                                                    <form method="POST" action="{{ route('cart.add') }}">
                                                        @csrf
                                                        <input type="hidden" name="menu_item_id"
                                                            value="{{ $coffee->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit"
                                                            class="button is-primary is-small has-text-weight-bold">Add to
                                                            Cart</button> {{-- Changed button text --}}
                                                    </form>
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
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hotCoffeeLink = document.getElementById('hot-coffees-link');
            const icedCoffeeLink = document.getElementById('cold-coffees-link');
            const frappeCoffeeLink = document.getElementById('frappe-coffees-link');

            const hotCoffeeSection = document.getElementById('hot-coffees');
            const icedCoffeeSection = document.getElementById('cold-coffees');
            const frappeCoffeeSection = document.getElementById('frappe-coffees');

            function highlightLink(link) {
                // Remove active class from other links
                document.querySelectorAll('.menu-list a').forEach(a => a.classList.remove('is-active',
                    'is-primary')); // Remove is-primary too
                link.classList.add('is-active', 'is-primary'); // Add is-primary
            }

            function checkActiveSection() {
                const hotCoffeeTop = hotCoffeeSection.offsetTop;
                const icedCoffeeTop = icedCoffeeSection.offsetTop;
                const frappeCoffeeTop = frappeCoffeeSection.offsetTop;
                const scrollPosition = window.scrollY;

                // Added check if sections exist before getting offsetTop
                if (frappeCoffeeSection && scrollPosition >= frappeCoffeeSection.offsetTop - 100) {
                    highlightLink(frappeCoffeeLink);
                } else if (icedCoffeeSection && scrollPosition >= icedCoffeeSection.offsetTop - 100) {
                    highlightLink(icedCoffeeLink);
                } else if (hotCoffeeSection && scrollPosition >= hotCoffeeSection.offsetTop - 100) {
                    highlightLink(hotCoffeeLink);
                }
            }

            // Removed event listeners for tea links, keeping only coffee links
            const coffeeLinks = [hotCoffeeLink, icedCoffeeLink, frappeCoffeeLink];
            coffeeLinks.forEach(link => {
                if (link) { // Check if the element exists
                    link.addEventListener('click', function(event) {
                        // Prevent default anchor behavior if navigating to a section on the same page
                        // event.preventDefault();

                        // Scroll to the target section (you might need a smooth scroll library for better UX)
                        const targetSection = document.getElementById(link.getAttribute('href')
                            .substring(1));
                        if (targetSection) {
                            window.scrollTo({
                                top: targetSection.offsetTop -
                                50, // Adjust offset if needed
                                behavior: 'smooth'
                            });
                        }
                    });
                }
            });


            window.addEventListener('scroll', checkActiveSection);
            window.addEventListener('load', checkActiveSection); // Call on page load too
        });
    </script>
@endsection
