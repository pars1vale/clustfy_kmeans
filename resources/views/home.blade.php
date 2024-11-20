@extends('layouts.backend.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-12 mb-4">
        <div class="hero text-white hero-bg-image"
          style="background-image: url('https://images.unsplash.com/photo-1618388810903-840bb0d15ea5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
          <div class="hero-inner">
            <h2>Welcome, {{ Auth::user()->name }} </h2>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. In impedit id dolore harum nobis laboriosam aut aspernatur fuga
              aliquam blanditiis error incidunt magnam ipsum ad quas voluptatem tempore, eius doloremque!.</p>
            <div class="mt-4">
              <a href="{{ route('users.index') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-level-up-alt"></i>See
                Visitors</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total User</h4>
            </div>
            <div class="card-body">
              {{ $totalusers }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-newspaper"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Framework Terdata</h4>
            </div>
            <div class="card-body">
              {{ $totalframework }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Library Terdata</h4>
            </div>
            <div class="card-body">
              {{ $totallibrary }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('page_js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
@endsection
