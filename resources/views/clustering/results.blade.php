<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <table class="table">
    <thead>
      <tr>
        <th>Data Point</th>
        <th>Cluster</th>
        <th>Centroid (Koordinat)</th>
        <th>Distance</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $row)
        <tr>
          <td>{{ $row['Data Point'] }}</td>
          <td>{{ $row['Cluster'] }}</td>
          <td>{{ $row['Centroid'] }}</td>
          <td>{{ $row['Distance'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

</body>

</html>
