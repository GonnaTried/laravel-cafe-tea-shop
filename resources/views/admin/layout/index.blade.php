<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <header>

        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            {{-- <a href="{{ route('admin.users.index') }}">Users</a> --}}

        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Admin Footer -->
    </footer>

    <!-- Add your admin JS scripts here -->
    <script src="{{ asset('js/admin.js') }}"></script> <!-- Example admin JS -->
</body>

</html>
