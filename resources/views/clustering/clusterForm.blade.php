<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form action="{{ route('clustering.showCentroidForm') }}" method="POST">
    @csrf
    <label for="k">Number of Clusters (k):</label>
    <input type="number" name="k" min="1" required>
    <button type="submit">Next</button>
  </form>

</body>

</html>
