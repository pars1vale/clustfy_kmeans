<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Centroid;
use App\Models\Datapoint;
use Illuminate\Http\Request;

class KMeansController extends Controller
{
    // Step 1: Tampilkan modal untuk memilih jumlah cluster (k)
    public function showClusterModal()
    {
        return view('kmeans.select_cluster');
    }

    // Step 2: Pilih centroid awal secara acak, dan tampilkan input untuk memilih centroid
    public function initializeCentroids(Request $request)
    {
        $k = $request->input('k'); // Retrieve the number of clusters
        $datapoints = Datapoint::all(); // Retrieve all data points to allow selection

        return view('kmeans.select_centroids', compact('k', 'datapoints')); // Pass $datapoints to the view
    }

    // Step 3: Proses K-Means Clustering
    public function cluster(Request $request)
    {
        $k = $request->input('k');
        $centroids = $this->initializeCentroidsFromInput($request); // Centroid dari input

        $dataPoints = Datapoint::with('attributes')->get(); // Ambil data points beserta atributnya
        $converged = false;
        $clusters = []; // Array untuk menyimpan hasil clustering

        while (!$converged) {
            $clusters = [];
            $distanceTable = []; // Array untuk menyimpan jarak

            // Step 3a: Assign each data point to the nearest centroid
            foreach ($dataPoints as $dataPoint) {
                $distances = [];
                foreach ($centroids as $index => $centroid) {
                    $distances[$index] = $this->calculateEuclideanDistance($dataPoint, $centroid);
                }
                $closestCluster = array_search(min($distances), $distances);
                $clusters[$closestCluster][] = $dataPoint;

                // Simpan jarak ke distanceTable untuk digunakan di view
                $distanceTable[$dataPoint->id] = $distances;
            }

            // Step 3b: Update centroids based on mean values
            $newCentroids = [];
            foreach ($clusters as $cluster) {
                $newCentroids[] = $this->calculateMeanCentroid($cluster);
            }

            // Check for convergence
            $converged = $this->checkConvergence($centroids, $newCentroids);
            $centroids = $newCentroids;
        }

        // Ambil semua atribut untuk diteruskan ke view
        $attributes = Attribute::all();

        return view('kmeans.result', compact('clusters', 'centroids', 'distanceTable', 'attributes'));
    }



    // Fungsi bantu untuk inisialisasi centroid dari input pengguna
    private function initializeCentroidsFromInput(Request $request)
    {
        $centroids = [];
        for ($i = 0; $i < $request->input('k'); $i++) {
            $centroidId = $request->input("centroid_$i");
            $centroids[] = Datapoint::find($centroidId);
        }
        return $centroids;
    }

    // Fungsi bantu untuk menghitung jarak Euclidean
    private function calculateEuclideanDistance($dataPoint, $centroid)
    {
        $distance = 0;
        foreach ($dataPoint->attributes as $attribute) {
            $centroidAttribute = $centroid->attributes->where('id', $attribute->id)->first();
            $distance += pow($attribute->pivot->value - $centroidAttribute->pivot->value, 2);
        }
        return sqrt($distance);
    }

    // Fungsi untuk menghitung centroid baru berdasarkan rata-rata nilai atribut
    private function calculateMeanCentroid($cluster)
    {
        $attributes = Attribute::all();
        $meanValues = [];

        foreach ($attributes as $attribute) {
            $total = 0;
            $count = 0;
            foreach ($cluster as $dataPoint) {
                $value = $dataPoint->attributes->where('id', $attribute->id)->first()->pivot->value;
                $total += $value;
                $count++;
            }
            $meanValues[$attribute->id] = $total / $count;
        }

        // Simpan centroid baru ke tabel centroids
        $centroid = Centroid::create(); // Buat centroid baru

        // Attach mean values ke centroid baru dalam tabel pivot centroid_attributes
        foreach ($meanValues as $attributeId => $meanValue) {
            $centroid->attributes()->attach($attributeId, ['value' => $meanValue]);
        }

        return $centroid;
    }


    // Fungsi bantu untuk mengecek apakah centroid sudah konvergen
    private function checkConvergence($oldCentroids, $newCentroids)
    {
        foreach ($oldCentroids as $index => $oldCentroid) {
            if ($this->calculateEuclideanDistance($oldCentroid, $newCentroids[$index]) > 0.0001) {
                return false;
            }
        }
        return true;
    }
}
