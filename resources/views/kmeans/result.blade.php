@if (!empty($finalClusters) && is_array($finalClusters))
  <table border="1">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        @if (!empty($finalCentroids))
          @for ($i = 1; $i <= count($finalCentroids); $i++)
            <th>Distance to Cluster {{ $i }}</th>
          @endfor
        @endif
        <th>Assigned Cluster</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($finalClusters as $clusterIndex => $cluster)
        @foreach ($cluster as $index => $dataPoint)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $dataPoint->name }}</td>
            @if (isset($finalDistanceTable[$dataPoint->id]))
              @foreach ($finalDistanceTable[$dataPoint->id] as $centroidIndex => $distance)
                <td>{{ $distance }}</td>
              @endforeach
            @endif
            <td>{{ $clusterIndex + 1 }}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
  </table>
@else
  <p>No clustering data available to display.</p>
@endif

<h3>Final Centroids</h3>
@if (!empty($finalCentroids))
  <table border="1">
    <thead>
      <tr>
        <th>#</th>
        @foreach ($attributes as $attribute)
          <th>{{ $attribute->name }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($finalCentroids as $index => $centroid)
        <tr>
          <td>centroid-{{ $index + 1 }}</td>
          @foreach ($centroid->attributes as $attribute)
            <td>{{ $attribute->pivot->value }}</td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p>No centroids available to display.</p>
@endif
