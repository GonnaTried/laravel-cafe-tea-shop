<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel</title>
    <!-- Add your staff CSS and JS here -->
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}"> <!-- Example staff CSS -->
</head>

<body>
    <header>
        <!-- Staff Navigation Bar -->
        <nav>
            <a href="{{ route('staff.dashboard') }}">Dashboard</a>
            <!-- Add more staff navigation links (e.g., Orders, Products to manage) -->
            {{-- <a href="{{ route('staff.orders.index') }}">Orders</a> --}}
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Staff Footer -->
    </footer>

    <!-- Add your staff JS scripts here -->
    <script src="{{ asset('js/staff.js') }}"></script> <!-- Example staff JS -->
</body>

</html>
