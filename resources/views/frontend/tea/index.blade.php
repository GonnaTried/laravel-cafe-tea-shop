{{-- resources/views/frontend/tea.blade.php --}}

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
                            {{-- Changed hrefs to point to the coffee page with anchors --}}
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
                                                    {{-- Corrected img tag structure --}}
                                                    <img src="{{ $tea->image_url }}" alt="{{ $tea->name }}">
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
                                                    {{-- **Add to Cart Form for Tea** --}}
                                                    <form method="POST" action="{{ route('cart.add') }}">
                                                        @csrf
                                                        {{-- Use $tea->id for the menu item --}}
                                                        <input type="hidden" name="menu_item_id"
                                                            value="{{ $tea->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        {{-- Default quantity to 1 --}}
                                                        <button type="submit"
                                                            class="button is-primary is-small has-text-weight-bold">Add to
                                                            Cart</button> {{-- Changed text to Add to Cart for consistency --}}
                                                    </form>
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
                                        {{-- Added anchor tag around the card image for consistency --}}
                                        <a href="{{ route('viewItem.index', $tea->slug) }}">
                                            <div class="card-image">
                                                <figure class="image is-4by5">
                                                    {{-- Corrected img tag structure --}}
                                                    <img src="{{ $tea->image_url }}" alt="{{ $tea->name }}">
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
                                                    {{-- **Add to Cart Form for Tea** --}}
                                                    <form method="POST" action="{{ route('cart.add') }}">
                                                        @csrf
                                                        {{-- Use $tea->id for the menu item --}}
                                                        <input type="hidden" name="menu_item_id"
                                                            value="{{ $tea->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        {{-- Default quantity to 1 --}}
                                                        <button type="submit"
                                                            class="button is-primary is-small has-text-weight-bold">Add to
                                                            Cart</button> {{-- Changed text to Add to Cart for consistency --}}
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
                // Remove active class from other links in both lists
                document.querySelectorAll('.menu-list a').forEach(a => a.classList.remove('is-active',
                    'is-primary'));
                link.classList.add('is-active', 'is-primary');
            }

            function checkActiveSection() {
                const scrollPosition = window.scrollY;
                // Get offsetTops only if sections exist
                const hotTeasTop = hotTeasSection ? hotTeasSection.offsetTop : -Infinity;
                const icedTeasTop = icedTeasSection ? icedTeasSection.offsetTop : -Infinity;

                // Check if sections exist before comparing
                if (icedTeasSection && scrollPosition >= icedTeasTop - 100) {
                    highlightLink(icedTeaLink);
                } else if (hotTeasSection && scrollPosition >= hotTeasTop - 100) {
                    highlightLink(hotTeaLink);
                }
                // No highlighting if neither section exists
            }

            // Add event listeners for tea links only
            const teaLinks = [hotTeaLink, icedTeaLink];
            teaLinks.forEach(link => {
                if (link) { // Check if the element exists
                    link.addEventListener('click', function(event) {
                        // Prevent default anchor behavior if navigating to a section on the same page
                        // event.preventDefault();

                        const targetSection = document.getElementById(link.getAttribute('href')
                            .substring(1));
                        if (targetSection) {
                            window.scrollTo({
                                top: targetSection.offsetTop - 50, // Adjust offset
                                behavior: 'smooth'
                            });
                        }
                    });
                }
            });


            window.addEventListener('scroll', checkActiveSection);
            window.addEventListener('load', checkActiveSection);
        });
    </script>
@endsection
