<!-- resources/views/kmeans/result.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clustering Result</title>
</head>

<body>
  <h3>Clustering Result</h3>

  <table border="1">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        @for ($i = 1; $i <= count($centroids); $i++)
          <th>Distance to Cluster {{ $i }}</th>
        @endfor
        <th>Assigned Cluster</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clusters as $clusterIndex => $cluster)
        @foreach ($cluster as $index => $dataPoint)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $dataPoint->name }}</td>
            @foreach ($distanceTable[$dataPoint->id] as $centroidIndex => $distance)
              <td>{{ $distance }}</td>
            @endforeach
            <td>{{ $clusterIndex + 1 }}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>

  </table>

  <h3>Final Centroids</h3>
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
      @foreach ($centroids as $index => $centroid)
        <tr>
          <td>centeroid-{{ $index + 1 }}</td>
          @foreach ($centroid->attributes as $attribute)
            <td>{{ $attribute->pivot->value }}</td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>

</body>

</html>
