<!-- filepath: /D:/ITN/SKRIPSI/clustfy_kmeans/resources/views/exports/datapoint.blade.php -->
<!DOCTYPE html>
<html>

<head>
  <style>
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      line-height: 1.6;
      color: #333;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }

    p {
      margin-bottom: 20px;
      text-align: justify;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th,
    table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    table th {
      background-color: #f2f2f2;
      color: #333;
      font-weight: bold;
    }

    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <h1>{{ $data['title'] }}</h1>
  <p>Excel Download: {{ $data['current_date_time'] }}</p>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
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
          <td>{{ $loop->iteration }}</td>
          <td>{{ $datapoint->name }}</td>
          <td>{{ $datapoint->type }}</td>
          @foreach ($attributes as $attribute)
            <!-- Menampilkan nilai berdasarkan attribute_id di tiap datapoint -->
            <td>
              @php
                // Mengambil nilai dari pivot table
                $pivot = $datapoint->attributes->where('id', $attribute->id)->first();
              @endphp
              {{ $pivot ? $pivot->pivot->value : 'N/A' }}
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
