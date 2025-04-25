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

            <a href="/staff"><strong class="navbar-item has-text-primary" style="font-size: 1.5em;">Staff
                    Panel</strong></a>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">


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
