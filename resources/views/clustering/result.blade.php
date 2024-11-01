@foreach ($iterations as $index => $iteration)
  <h2>Iteration {{ $index + 1 }}</h2>
  <table>
    <tr>
      <th>Cluster</th>
      <th>Datapoints</th>
      <th>Centroid</th>
    </tr>
    @foreach ($iteration['clusters'] as $clusterId => $cluster)
      <tr>
        <td>{{ $clusterId + 1 }}</td>
        <td>
          @foreach ($cluster as $datapoint)
            {{ $datapoint->name }},
          @endforeach
        </td>
        <td>
          @foreach ($iteration['centroids'][$clusterId] as $attributeId => $value)
            {{ $value }},
          @endforeach
        </td>
      </tr>
    @endforeach
  </table>
@endforeach

<h2>Final Clustering Result</h2>
<table>
  <tr>
    <th>Cluster</th>
    <th>Datapoints</th>
  </tr>
  @foreach ($clusters as $clusterId => $cluster)
    <tr>
      <td>{{ $clusterId + 1 }}</td>
      <td>
        @foreach ($cluster as $datapoint)
          {{ $datapoint->name }},
        @endforeach
      </td>
    </tr>
  @endforeach
</table>
