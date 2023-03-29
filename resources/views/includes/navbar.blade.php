<div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

  <h1 class="logo me-auto me-lg-0"><a href="/">BurgerTime</a></h1>
  <!-- Uncomment below if you prefer to use an image logo -->
  <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

  <nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
      <li><li><a class="nav-link scrollto {{ request()->is('/') ? 'active' : '' }}" href="{{ request()->is('/') ? '#hero' : '/' }}">Home</a></li></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#about' : '/' }}" onclick="scrollToSection(event, 'about')">About</a></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#menu' : '/' }}" onclick="scrollToSection(event, 'menu')">Menu</a></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#specials' : '/' }}" onclick="scrollToSection(event, 'specials')">Specials</a></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#events' : '/' }}" onclick="scrollToSection(event, 'events')">Events</a></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#chefs' : '/' }}" onclick="scrollToSection(event, 'chefs')">Chefs</a></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#gallery' : '/' }}" onclick="scrollToSection(event, 'gallery')">Gallery</a></li>
      <li><a class="nav-link scrollto" href="{{ request()->is('/') ? '#contact' : '/' }}" onclick="scrollToSection(event, 'contact')">Contact</a></li>
      
      @auth
      <li>
        <a class="nav-link scrollto" href="/dashboard">Dashboard</a>
      </li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" class="nav-link scrollto" onclick="event.preventDefault();
                            this.closest('form').submit();">
            Logout
          </a>
        </form>
      </li>
      @else
      <li>
        <a class="nav-link scrollto" href="/login">Entrar</a>
      </li>
      <li>
        <a class="nav-link scrollto" href="/register">Registre-se</a>
      </li>
      @endauth
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->
  <a href="#book-a-table" class="book-a-table-btn scrollto d-none d-lg-flex">Book a table</a>

</div>

