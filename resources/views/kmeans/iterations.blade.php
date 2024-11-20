@extends('layouts.backend.app')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Iterasi Clustering</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('kmeans.select_cluster') }}">Initialize Cluster</a></div>
        <div class="breadcrumb-item">Select Centeroid of Cluster</div>
        <div class="breadcrumb-item">Iterations</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Iterations K-Means</h2>
      <p class="section-lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorum cumque repellendus voluptatibus unde possimus eius
        accusantium corporis? Fugiat dolorum harum corporis nobis perspiciatis, laboriosam et consectetur delectus rerum nam dolores!</p>
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Scatter Chart</h4><br>
              <p class="section-lead">sumbu y adalah : Size-Logical Lines of Code (LLOC)</p><br>
              <p class="section-lead">sumbu x adalah : Classes-Average Methods Per Class</p>
            </div>
            <div class="card-body">
              <div class="chartjs-size-monitor"
                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand"
                  style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                  <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink"
                  style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                  <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
              </div>
              <canvas id="scatterChart" width="200" height="196" style="display: block; width: 200px; height: 196px;"
                class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Doughnut Chart</h4>
            </div>
            <div class="card-body">
              <div class="chartjs-size-monitor"
                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand"
                  style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                  <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink"
                  style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                  <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
              </div>
              <canvas id="doughnut" width="200" height="196" style="display: block; width: 200px; height: 196px;"
                class="chartjs-render-monitor"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3>Final Clustering Result</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table border="1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    @for ($i = 1; $i <= count($finalCentroids); $i++)
                      <th>Distance to Cluster {{ $i }}</th>
                    @endfor
                    <th>Assigned Cluster</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($finalClusters as $clusterIndex => $cluster)
                    @foreach ($cluster as $index => $dataPoint)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $dataPoint->name }}</td>
                        @foreach ($finalDistanceTable[$dataPoint->id] as $centroidIndex => $distance)
                          <td>{{ $distance }}</td>
                        @endforeach
                        <td>{{ $clusterIndex + 1 }}</td>
                      </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-12">
        @foreach ($iterations as $iterationIndex => $iteration)
          <div class="card">
            <div class="card-header">
              <h4>Iteration {{ $iterationIndex + 1 }}</h4>
            </div>
            <div class="card-body">
              <div class="buttons">
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Aw, yeah!</button>
                <a href="{{ route('datapoints.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> add atribute</a>
                <a href="#" class="btn btn-outline-primary">export as PDF</a>
                <a href="#" class="btn btn-outline-primary">export as CSV/.xls</a> --}}
              </div>

              <div class="table-responsive">
                <!-- Tampilkan Tabel Data Points dan Jarak ke Centroid -->
                <h5>distance calculation results</h5>
                <table border="1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      @for ($i = 1; $i <= count($iteration['centroids']); $i++)
                        <th>Distance to Cluster {{ $i }}</th>
                      @endfor
                      <th>Assigned Cluster</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($iteration['clusters'] as $clusterIndex => $cluster)
                      @foreach ($cluster as $index => $dataPoint)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          {{-- <td>{{ $index + 1 }}</td> --}}
                          <td>{{ $dataPoint->name }}</td>
                          @foreach ($iteration['distanceTable'][$dataPoint->id] as $centroidIndex => $distance)
                            <td>{{ $distance }}</td>
                          @endforeach
                          <td>{{ $clusterIndex + 1 }}</td>
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>

                <!-- Tampilkan Tabel Centroid untuk Iterasi Ini -->
                <h5>Centroids for Iteration {{ $iterationIndex + 1 }}</h5>
                <table border="1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      @foreach ($attributes as $attribute)
                        <th>{{ $attribute->name }}</th> <!-- Use attribute names here -->
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($iteration['centroids'] as $index => $centroid)
                      <tr>
                        <td>centroid-{{ $index + 1 }}</td>
                        @foreach ($centroid->attributes as $attribute)
                          <td>{{ $attribute->pivot->value }}</td>
                        @endforeach
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <br>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endsection

  @section('page_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script>
      var clusterData = @json($clusterData);
    </script>
    <script>
      var ctx = document.getElementById('scatterChart').getContext('2d');
      var scatterChart = new Chart(ctx, {
        type: 'scatter',
        data: {
          datasets: Object.keys(clusterData).map(function(clusterIndex) {
            return {
              label: 'Cluster ' + clusterIndex,
              data: clusterData[clusterIndex].map(function(dataPoint) {
                return {
                  x: dataPoint.x, // nilai untuk sumbu X
                  y: dataPoint.y, // nilai untuk sumbu Y
                  label: dataPoint.name // nama data point (opsional)
                };
              }),
              backgroundColor: randomColor(), // Atur warna untuk setiap cluster
            };
          })
        },
        options: {
          responsive: true,
          scales: {
            x: {
              type: 'linear',
              position: 'bottom'
            },
            y: {
              type: 'linear',
            }
          },
          plugins: {
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  return 'Nama: ' + tooltipItem.raw.label + ' | X: ' + tooltipItem.raw.x + ' | Y: ' + tooltipItem.raw.y;
                }
              }
            }
          }
        }
      });

      // Fungsi untuk menghasilkan warna acak
      function randomColor() {
        return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.6)';
      }
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {

        // Ambil data jumlah cluster dari PHP
        const clusterCounts = @json($clusterCounts); // Mengonversi data PHP ke JavaScript

        // Buat label untuk cluster
        const labels = clusterCounts.map((_, index) => `Cluster ${index + 1}`);

        const data = {
          labels: labels,
          datasets: [{
            label: 'Total Data',
            data: clusterCounts, // Data jumlah setiap cluster
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(153, 102, 255)',
              'rgb(255, 159, 64)',
              // Tambahkan lebih banyak warna jika ada lebih banyak cluster
            ],
            hoverOffset: 4,
            weight: 200
          }]
        };

        const config = {
          type: 'doughnut',
          data: data,
        };

        new Chart(
          document.getElementById('doughnut'),
          config
        );
      });
    </script>
  @endsection
