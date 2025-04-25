<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Added CSRF token for forms --}}

    <title>Staff - @yield('title', 'Dashboard')</title> {{-- Adjusted title and default --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    {{-- Bulma CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    {{-- Font Awesome CDN for Icons --}}
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">

    @stack('styles') {{-- Using @stack for styles, consistent with the layout structure --}}

    <style>
        .menu {
            position: sticky;
            display: inline-block;
            vertical-align: top;
            max-height: 100vh;
            overflow-y: auto;
            width: 200px;
            top: 0;
            bottom: 0;
            padding: 30px;
        }

        .content-container {
            display: inline-block;
            flex-grow: 1;
            /* Allow content to take up remaining space */
            padding: 30px;
            /* Added padding for content */
        }

        /* Adjusted for a better layout structure with sidebar and content */
        .main-layout {
            display: flex;
        }

        /* Add some basic responsiveness */
        @media (max-width: 768px) {
            .main-layout {
                flex-direction: column;
            }

            .menu {
                width: 100%;
                max-height: none;
                overflow-y: visible;
                position: relative;
            }

            .content-container {
                padding: 10px;
                /* Adjust padding for smaller screens */
            }
        }
    </style>
</head>

<body>

    <header>
        @include('staff.layout.header')
    </header>

    {{-- Main layout with sidebar and content area --}}
    <div class="main-layout">

        {{-- Main content area --}}
        <main class="content-container">
            {{-- **Add flash message display here** --}}
            @if (session('success'))
                <br>
                <div class="notification is-success">
                    <button class="delete"></button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="notification is-danger">
                    <button class="delete"></button>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content') {{-- Your page content goes here --}}
        </main>
    </div>

    <footer>
        {{-- @include('staff.layout.footer') --}} {{-- Include a staff-specific footer --}}
    </footer>

    {{-- For Font Awesome JS if needed (e.g., for advanced features) --}}
    <script src="{{ asset('fontawesome-free-6.7.2-web/js/all.min.js') }}"></script>
    <script>
        // Script to make Bulma notifications dismissible
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
