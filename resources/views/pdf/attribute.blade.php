<!DOCTYPE html>
<html>

<head>
  <h1>{{ $data['title'] }}</h1>
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

    /* Page Margins */
    @page {
      margin: 20px;
    }

    /* PDF-specific adjustments */
    body {
      margin: 10px;
    }
  </style>
</head>

<body>
  <h1>{{ $data['title'] }}</h1>
  <p>PDF Download: {{ $data['current_date_time'] }}</p>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($attributes as $attribute)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $attribute->name }}</td>
          <td>{{ $attribute->description }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
