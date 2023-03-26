<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="">BurgerTime</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                            this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="/login">Entrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Registre-se</a>
            </li>
            @endauth
        </ul>
    </div>
</nav>