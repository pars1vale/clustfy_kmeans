<div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('home') }}">clustering</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('home') }}">Cl</a>
    </div>
    <ul class="sidebar-menu">
      {{-- <li class="dropdown active">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        <ul class="dropdown-menu">
          <li class="active"><a class="nav-link" href="index-0.html">General Dashboard</a></li>
          <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
        </ul>
      </li> --}}
      <li class=" {{ request()->is('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}"><i
            class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Cluster</li>
      <li class="{{ request()->is('datapoints') ? 'active' : '' }}"><a class="nav-link" href="{{ route('datapoints.index') }}"><i
            class="far fa-file-powerpoint"></i> <span>Datapoint</span></a></li>
      <li class="{{ request()->is('attributes') ? 'active' : '' }}"><a class="nav-link" href="{{ route('attributes.index') }}"><i
            class="fas fa-list-ol"></i><span>Atributes</span></a></li>
      <li><a class="nav-link" href="blank.html"><i class="far fa-list-alt"></i><span>Clustering</span></a></li>
      <li class="menu-header">admin area</li>
      <li><a class="nav-link" href="blank.html"><i class="fas fa-users"></i><span>Pengguna</span></a></li>
    </ul>
  </aside>
</div>
