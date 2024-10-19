<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <h1>hello</h1>
  <table border="1px">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        @foreach ($attributes as $attribute)
          <th>{{ $attribute->name }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($datapoints as $datapoint)
        <tr>
          <td>{{ $datapoint->name }}</td>
          <td>{{ $datapoint->type }}</td>
          @foreach ($attributes as $attribute)
            <!-- Menampilkan nilai berdasarkan attribute_id di tiap datapoint -->
            <td>{{ $datapoint->attribute_id == $attribute->id ? $datapoint->getAttributeValue($attribute->name) : 'N/A' }}</td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="container">
    <h2>Buat DataPoint Baru</h2>

    <form action="{{ route('datapoints.store') }}" method="POST">
      @csrf

      <!-- Input untuk name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
      </div>

      <!-- Input untuk type -->
      <div class="form-group">
        <label for="type">Type</label>
        <select class="form-control" id="type" name="type" required>
          <option value="framework" {{ old('type') == 'framework' ? 'selected' : '' }}>Framework</option>
          <option value="library" {{ old('type') == 'library' ? 'selected' : '' }}>Library</option>
        </select>
      </div>

      <!-- Looping untuk setiap attribute -->
      @foreach ($attributes as $attribute)
        <div class="form-group">
          <label for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
          <input type="number" class="form-control" id="attribute-{{ $attribute->id }}" name="attributes[{{ $attribute->id }}]"
            value="{{ old('attributes.' . $attribute->id) }}" required>
        </div>
      @endforeach

      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>

</body>

</html>
