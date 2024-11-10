@extends('layouts.backend.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Iterasi Clustering</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('kmeans.select_cluster') }}">Initialize Cluster</a></div>
        <div class="breadcrumb-item">Select Centeroid of Cluster</div>
        <div class="breadcrumb-item">Iterations</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Iterations K-Means</h2>
      <p class="section-lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorum cumque repellendus voluptatibus unde possimus eius
        accusantium corporis? Fugiat dolorum harum corporis nobis perspiciatis, laboriosam et consectetur delectus rerum nam dolores!</p>
      <div class="col-12 col-md-12 col-lg-12">
        @foreach ($iterations as $iterationIndex => $iteration)
          <div class="card">
            <div class="card-header">
              <h4>Iteration {{ $iterationIndex + 1 }}</h4>
            </div>
            <div class="card-body">
              <div class="buttons">
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button>
                <a href="{{ route('datapoints.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> add atribute</a>
                <a href="#" class="btn btn-outline-primary">export as PDF</a>
                <a href="#" class="btn btn-outline-primary">export as CSV/.xls</a> --}}
              </div>

              <div class="table-responsive">
                <!-- Tampilkan Tabel Data Points dan Jarak ke Centroid -->
                <h5>distance calculation results</h5>
                <table border="1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      @for ($i = 1; $i <= count($iteration['centroids']); $i++)
                        <th>Distance to Cluster {{ $i }}</th>
                      @endfor
                      <th>Assigned Cluster</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($iteration['clusters'] as $clusterIndex => $cluster)
                      @foreach ($cluster as $index => $dataPoint)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          {{-- <td>{{ $index + 1 }}</td> --}}
                          <td>{{ $dataPoint->name }}</td>
                          @foreach ($iteration['distanceTable'][$dataPoint->id] as $centroidIndex => $distance)
                            <td>{{ $distance }}</td>
                          @endforeach
                          <td>{{ $clusterIndex + 1 }}</td>
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>

                <!-- Tampilkan Tabel Centroid untuk Iterasi Ini -->
                <h5>Centroids for Iteration {{ $iterationIndex + 1 }}</h5>
                <table border="1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      @foreach ($attributes as $attribute)
                        <th>{{ $attribute->name }}</th> <!-- Use attribute names here -->
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($iteration['centroids'] as $index => $centroid)
                      <tr>
                        <td>centroid-{{ $index + 1 }}</td>
                        @foreach ($centroid->attributes as $attribute)
                          <td>{{ $attribute->pivot->value }}</td>
                        @endforeach
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <br>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <h3>Final Clustering Result</h3>
    <table border="1">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          @for ($i = 1; $i <= count($finalCentroids); $i++)
            <th>Distance to Cluster {{ $i }}</th>
          @endfor
          <th>Assigned Cluster</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($finalClusters as $clusterIndex => $cluster)
          @foreach ($cluster as $index => $dataPoint)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $dataPoint->name }}</td>
              @foreach ($finalDistanceTable[$dataPoint->id] as $centroidIndex => $distance)
                <td>{{ $distance }}</td>
              @endforeach
              <td>{{ $clusterIndex + 1 }}</td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  @endsection
