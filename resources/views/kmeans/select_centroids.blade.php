<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Initial Centroids</title>
</head>

<body>
  <form action="{{ route('kmeans.cluster') }}" method="POST">
    @csrf
    <input type="hidden" name="k" value="{{ $k }}">
    <h3>Select Initial Centroids</h3>

    <!-- Loop to create exactly 'k' dropdowns -->
    @for ($i = 0; $i < $k; $i++)
      <label for="centroid_{{ $i }}">Centroid {{ $i + 1 }}:</label>
      <select name="centroid_{{ $i }}" id="centroid_{{ $i }}">
        @foreach ($datapoints as $point)
          <option value="{{ $point->id }}">{{ $point->name }}</option>
        @endforeach
      </select>
      <br>
    @endfor

    <button type="submit">Start Clustering</button>
  </form>
</body>

</html>
