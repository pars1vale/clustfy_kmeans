</header>
<header class="mb-auto">
  <div>
    <h3 class="float-md-start mb-0">Cover</h3>
    <nav class="nav nav-masthead justify-content-center float-md-end">
      @if (Route::has('login'))
        @auth
          <a class="nav-link fw-bold py-1 px-0 " aria-current="page" href="{{ route('home') }}">Dashboard</a>
        @else
          <a class="nav-link fw-bold py-1 px-0" href="{{ route('login') }}">Login</a>
          @if (Route::has('register'))
            <a class="nav-link fw-bold py-1 px-0" href="{{ route('register') }}">Contact</a>
          @endif
        @endauth
      @endif
    </nav>
  </div>
</header>
