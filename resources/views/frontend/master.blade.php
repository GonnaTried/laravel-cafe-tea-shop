<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Cafe and Tea')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Bulma CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    {{-- Font Awesome CDN for Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5tyNVMo/DfUtg+VtaRQPPezdhA8wn6cp+NOOhctISMmO93Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('styles')
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

        .content {
            display: inline-block;
        }

        .columns is-multiline {
            align-items: center;
            # make it in a align
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            @include('frontend.header')
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            @include('frontend.footer')
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> <!-- Link to your main JavaScript file -->
    @yield('scripts') <!-- Yield for page-specific scripts -->
</body>

</html>
