<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - @yield('title')</title>

    <!-- Admin Specific Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"> {{-- You'll need to create/compile this --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css"> {{-- Or your preferred CSS framework --}}
    {{-- Font Awesome or other icon library --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @yield('styles')
</head>

<body>
    <div id="app"> {{-- Optional: If you use Vue/React --}}
        <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ route('admin.dashboard') }}">
                    Admin Panel
                </a>
                {{-- Burger icon for mobile --}}
            </div>

            <div id="adminNavbar" class="navbar-menu">
                <div class="navbar-start">
                    {{-- Admin Navigation Links --}}
                    <a class="navbar-item" href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                    <a class="navbar-item" href="{{ route('admin.menu-items.index') }}"> {{-- Example link --}}
                        Manage Menu Items
                    </a>
                    <a class="navbar-item" href="{{ route('admin.orders.index') }}"> {{-- Example link --}}
                        Manage Orders
                    </a>
                    {{-- Add links for other managed resources --}}
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        {{-- User Info and Logout --}}
                        @auth
                            <span class="navbar-item">
                                Logged in as: {{ Auth::user()->name ?? Auth::user()->phone }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="button is-danger is-small">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <section class="section">
            <div class="container">
                {{-- Display flash messages (success, error) --}}
                @if (session('success'))
                    <div class="notification is-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="notification is-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>

    <!-- Admin Specific Scripts -->
    <script src="{{ asset('js/admin.js') }}"></script> {{-- You'll need to create/compile this --}}
    @yield('scripts')
</body>

</html>
