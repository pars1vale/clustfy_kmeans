<div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('/') }}">clustering</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('/') }}">Cl</a>
    </div>
    <ul class="sidebar-menu">
      <li class=" {{ request()->is('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}"><i
            class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Cluster</li>
      <li class="{{ request()->is('datapoints*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('datapoints.index') }}"><i
            class="far fa-file-powerpoint"></i> <span>Datapoint</span></a></li>
      <li class="{{ request()->is('attributes*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('attributes.index') }}"><i
            class="fas fa-list-ol"></i><span>Atributes</span></a></li>
      {{-- <li class="dropdown {{ request()->is('kmeans*' ? 'active' : '') }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-list-alt"></i> <span>Clustering</span></a>
        <ul class="dropdown-menu" style="display: block;">
          <li><a class="nav-link {{ request()->is('kmeans*' ? 'active' : '') }}" href="{{ route('kmeans.select_cluster') }}">Initialize Cluster</a>
          </li>
          <li><a class="nav-link {{ request()->is('kmeans*' ? 'active' : '') }}" href="{{ route('kmeans.cluster_iterations') }}">Iterations</a></li>
          <li><a class="nav-link {{ request()->is('kmeans*' ? 'active' : '') }}" href="{{ route('kmeans.result') }}">Clusterin Results</a></li>
        </ul>
      </li> --}}
      <li class="dropdown {{ request()->is('kmeans*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kmeans.select_cluster') }}"><i
            class="far fa-list-alt"></i><span>Clustering</span></a></li>
      <li class="menu-header">admin area</li>
      <li class="{{ request()->is('users*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i
            class="fas fa-users"></i><span>Users</span></a></li>
    </ul>
  </aside>
</div>
