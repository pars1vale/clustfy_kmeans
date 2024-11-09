@extends('layouts.backend.app')
@section('plugins_css')
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/prism/prism.css') }}">
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Select Centeroid of Cluster</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('kmeans.select_cluster') }}">Initialize Cluster</a></div>
        <div class="breadcrumb-item">Select Centeroid of Cluster</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Initialize Centeroid of Cluster</h2>
      <p class="section-lead">
        Configure the number of clusters for initializing the K-Means algorithm.
      </p>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Select Centeroid</h4>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Select Centeroid</button>
          </div>
          <div class="card-footer text-right"></div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Initial Centroids</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('kmeans.cluster_iterations') }}" method="POST">
            @csrf
            <input type="hidden" name="k" value="{{ $k }}">
            <!-- Loop to create exactly 'k' dropdowns -->
            @for ($i = 0; $i < $k; $i++)
              <label for="centroid_{{ $i }}">Centroid Of Cluster-{{ $i + 1 }}:</label>
              <select class="form-control" name="centroid_{{ $i }}" id="centroid_{{ $i }}">
                @foreach ($datapoints as $point)
                  <option value="{{ $point->id }}">{{ $point->name }}</option>
                @endforeach
              </select>
              <br>
            @endfor
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('plugins_js')
  <script src="{{ asset('assets/stisla/modules/prism/prism.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('page_js')
  <script>
    $(document).ready(function() {
      // Buka modal saat halaman dimuat
      $('#exampleModal').modal('show');
    });
  </script>
@endsection
