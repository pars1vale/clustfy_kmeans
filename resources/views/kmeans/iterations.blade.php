@extends('layouts.backend.app')
@section('content')
  <h3>Iterations</h3>

  @foreach ($iterations as $iterationIndex => $iteration)
    <h4>Iteration {{ $iterationIndex + 1 }}</h4>

    <!-- Tampilkan Tabel Centroid untuk Iterasi Ini -->
    <h5>Centroids for Iteration {{ $iterationIndex + 1 }}</h5>
    <table border="1">
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

    <!-- Tampilkan Tabel Data Points dan Jarak ke Centroid -->
    <table border="1">
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
              <td>{{ $index + 1 }}</td>
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
  @endforeach

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
