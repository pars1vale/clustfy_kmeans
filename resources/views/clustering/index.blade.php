@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Clustering</h1>

    <!-- Display Clustering Iterations Table -->
    <h2>Iterasi</h2>
    <table border="1">
      <thead>
        <tr>
          <th>Cluster</th>
          @foreach ($attributes as $attribute)
            <th>{{ $attribute->name }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse ($iterations as $iterationIndex => $clusters)
          <tr>
            <td colspan="{{ count($attributes) + 1 }}">Iterasi {{ $iterationIndex + 1 }}</td>
          </tr>
          @foreach ($clusters as $clusterIndex => $datapoints)
            <tr>
              <td>Cluster {{ $clusterIndex + 1 }}</td>
              @foreach ($datapoints as $datapoint)
                @foreach ($datapoint->attributes as $attribute)
                  <td>{{ $attribute->pivot->value }}</td>
                @endforeach
              @endforeach
            </tr>
          @endforeach
        @empty
          <tr>
            <td colspan="{{ count($attributes) + 1 }}">Tidak ada data</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Display Final Centroids Table -->
    <h2>Hasil Iterasi Centeroid</h2>
    <table border="1">
      <thead>
        <tr>
          <th>Cluster</th>
          @foreach ($attributes as $attribute)
            <th>{{ $attribute->name }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse ($finalCentroids as $clusterIndex => $centroid)
          <tr>
            <td>Cluster {{ $clusterIndex + 1 }}</td>
            @foreach ($attributes as $attribute)
              <td>{{ $centroid[$attribute->id] ?? 'N/A' }}</td>
            @endforeach
          </tr>
        @empty
          <tr>
            <td colspan="{{ count($attributes) + 1 }}">Tidak ada data</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Start Clustering Button -->
    <form action="{{ route('kmeans.startClustering') }}" method="POST" onsubmit="return startClustering()">
      @csrf
      <button type="submit">Mulai Clustering</button>
    </form>

    <script>
      function startClustering() {
        let numClusters = prompt("Masukkan jumlah cluster:");

        if (numClusters === null || numClusters.trim() === "" || isNaN(numClusters) || numClusters < 1) {
          alert("Silakan masukkan angka yang valid untuk jumlah cluster.");
          return false;
        }

        // Create hidden input to pass numClusters to the controller
        let form = document.querySelector("form");
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = "num_clusters";
        input.value = numClusters;
        form.appendChild(input);

        return true;
      }
    </script>
  </div>
@endsection
