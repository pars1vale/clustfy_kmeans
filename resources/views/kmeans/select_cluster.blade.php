<!-- resources/views/kmeans/select_cluster.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Cluster</title>
</head>

<body>
  <form action="{{ route('kmeans.initialize_centroids') }}" method="POST">
    @csrf
    <label for="k">Enter Number of Clusters (k):</label>
    <input type="number" name="k" id="k" min="1" required>
    <button type="submit">Submit</button>
  </form>
</body>

</html>
