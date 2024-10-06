<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapoint;
use App\Models\Centroid;
use App\Models\ClusteringResult;
use DB;

class KMeansController extends Controller
{
    // Menampilkan form untuk menentukan jumlah cluster dan memilih titik centroid
    public function index()
    {
        $datapoints = Datapoint::all();
        return view('kmeans.index', compact('datapoints'));
    }

    // Proses clustering
    public function processClustering(Request $request)
    {
        $clusters = $request->input('clusters'); // Jumlah cluster
        $selectedCentroids = $request->input('centroids'); // Titik centroid yang dipilih user

        // Inisialisasi centroid berdasarkan input user
        $centroids = [];
        foreach ($selectedCentroids as $clusterNumber => $datapointId) {
            $datapoint = Datapoint::find($datapointId);
            $centroids[$clusterNumber] = $datapoint;
        }

        // Iterasi K-Means
        $iterations = [];
        $maxIterations = 100; // limit iterasi
        for ($i = 0; $i < $maxIterations; $i++) {
            $iterationResults = [];

            // Reset hasil clustering sebelumnya
            ClusteringResult::truncate();

            foreach (Datapoint::all() as $datapoint) {
                $minDistance = null;
                $closestCentroid = null;

                // Hitung jarak ke setiap centroid
                foreach ($centroids as $clusterNumber => $centroid) {
                    $distance = $this->calculateDistance($datapoint, $centroid);

                    if ($minDistance === null || $distance < $minDistance) {
                        $minDistance = $distance;
                        $closestCentroid = $clusterNumber;
                    }
                }

                // Simpan hasil ke database
                ClusteringResult::create([
                    'datapoint_id' => $datapoint->id,
                    'centroid_id' => $centroids[$closestCentroid]->id,
                    'cluster_number' => $closestCentroid,
                    'distance' => $minDistance,
                ]);

                $iterationResults[] = [
                    'datapoint' => $datapoint,
                    'cluster' => $closestCentroid,
                    'distance' => $minDistance,
                ];
            }

            // Simpan hasil iterasi
            $iterations[] = $iterationResults;

            // Update centroid baru
            $newCentroids = $this->recalculateCentroids($iterations[$i], $clusters);

            // Periksa jika centroid tidak berubah
            if ($centroids == $newCentroids) {
                break;
            }

            $centroids = $newCentroids;
        }

        // Tampilkan hasil akhir dan iterasi
        return view('kmeans.results', compact('iterations'));
    }

    // Menghitung jarak (Euclidean Distance)
    private function calculateDistance($datapoint, $centroid)
    {
        // Implementasi logika jarak euclidean antara $datapoint dan $centroid
        return sqrt(pow($datapoint->attribute_id - $centroid->attribute_id, 2));
    }

    // Menghitung ulang centroid
    private function recalculateCentroids($iterationResults, $clusters)
    {
        $newCentroids = [];
        foreach (range(0, $clusters - 1) as $clusterNumber) {
            $clusterPoints = array_filter($iterationResults, function ($result) use ($clusterNumber) {
                return $result['cluster'] == $clusterNumber;
            });

            if (!empty($clusterPoints)) {
                $sumAttribute = array_reduce($clusterPoints, function ($carry, $point) {
                    return $carry + $point['datapoint']->attribute_id;
                }, 0);

                $averageAttribute = $sumAttribute / count($clusterPoints);

                // Cari datapoint terdekat dengan nilai rata-rata sebagai centroid baru
                $closestToAverage = collect($clusterPoints)->sortBy(function ($point) use ($averageAttribute) {
                    return abs($point['datapoint']->attribute_id - $averageAttribute);
                })->first();

                $newCentroids[$clusterNumber] = $closestToAverage['datapoint'];
            }
        }

        return $newCentroids;
    }
}
