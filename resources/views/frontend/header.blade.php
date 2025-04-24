{{-- resources/views/frontend/header.blade.php --}}

<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        {{-- Your logo or brand goes here --}}

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">

        <div class="navbar-start">

            <a href="{{ url('/') }}" class="navbar-item"> {{-- Use url('/') or route('home') --}}
                Home
            </a>

            <a href="/location" class="navbar-item">
                Location
            </a>

            <a href="/tea" class="navbar-item">
                Tea
            </a>

            <a href="/coffee" class="navbar-item">
                Coffees
            </a>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    {{-- Cart Icon and Count --}}
                    <a href="{{ route('cart.view') }}" class="button is-text">
                        <span class="icon">
                            {{-- Your Cart Icon GIF --}}
                            <img src="{{ asset('images/shopping-bag-white.png') }}" alt="Shopping Cart">
                            {{-- Updated path and filename --}}
                        </span>
                        {{-- Display the item count --}}
                        <span class="tag is-primary is-rounded">
                            {{ $cartItemCount ?? 0 }}
                        </span>
                    </a>

                    @auth
                        <a href="{{ route('order.history') }}" class="navbar-item">
                            Order History
                        </a>
                    @endauth

                    {{-- ... Login/Register/Logout buttons ... --}}
                    @guest
                        <a href="{{ route('register') }}" class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                        <a href="{{ route('login') }}" class="button is-light">
                            Log in
                        </a>
                    @endguest

                    @auth
                        <span class="navbar-item">
                            <strong> Welcome, {{ Auth::user()->phone }}!</strong>
                        </span>

                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="button is-danger">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
