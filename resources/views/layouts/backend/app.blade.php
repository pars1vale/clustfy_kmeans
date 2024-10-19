<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Clustering')</title>
  {{-- <link rel="shortcut icon" href="{{ asset('assets/landing/images/service-image.png') }}" type="image/svg+xml"> --}}
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/components.css') }}">
  @stack('styles')
  @vite(['resources/js/app.js'])
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @include('layouts.backend.navbar')
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">Clustering</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">Cl</a>
          </div>
          @include('layouts.backend.sidebar')
        </aside>
      </div>
      <div class="main-content" style="min-height: 816px;">
        @yield('content')
      </div>
      @include('layouts.backend.footer')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('assets/stisla/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/moment.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/custom.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/page/chart.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/page/modules-chartjs.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/page/bootstrap-modal.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/prism/prism.js') }}"></script>
  @stack('scripts')
</body>

</html>
