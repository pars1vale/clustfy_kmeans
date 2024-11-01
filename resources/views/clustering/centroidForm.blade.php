<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form action="{{ route('clustering.perform') }}" method="POST">
    @csrf
    <h3>Select Initial Centroids for Each Cluster</h3>
    <input type="hidden" name="k" value="{{ $k }}">

    @for ($i = 1; $i <= $k; $i++)
      <label for="centroid-{{ $i }}">Select Initial Centroid for Cluster {{ $i }}:</label>
      <select name="centroids[]" id="centroid-{{ $i }}" required>
        @foreach ($datapoints as $datapoint)
          <option value="{{ $datapoint->id }}">{{ $datapoint->name }}</option>
        @endforeach
      </select>
      <br>
    @endfor

    <button type="submit">Perform Clustering</button>
  </form>

</body>

</html>
