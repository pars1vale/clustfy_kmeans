<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="">Clusify</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">

          @if (Route::has('login'))
            @auth
              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Log In</a>
              </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
              @endif
            @endauth
          @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Clustering
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Do Clustering</a></li>
              <li><a class="dropdown-item" href="#">Datapoints</a></li>
              <li><a class="dropdown-item" href="#">Attributes</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
