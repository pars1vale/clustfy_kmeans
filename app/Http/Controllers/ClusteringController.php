<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapoint;
use App\Models\Attribute;

class ClusteringController extends Controller
{
    // Menampilkan form untuk menentukan jumlah cluster (Langkah 1)
    public function showClusterForm()
    {
        return view('clustering.clusterForm');
    }

    // Menampilkan form untuk memilih centroid setelah jumlah cluster ditentukan (Langkah 2)
    public function showCentroidForm(Request $request)
    {
        $k = $request->input('k');
        $datapoints = Datapoint::all(); // Ambil semua data untuk pilihan centroid
        return view('clustering.centroidForm', compact('k', 'datapoints'));
    }

    // Melakukan proses clustering berdasarkan input pengguna
    public function performClustering(Request $request)
    {
        $k = $request->input('k');
        $initialCentroids = $request->input('centroids'); // array berisi ID dari centroid awal

        // Mengambil semua datapoint beserta atributnya
        $datapoints = Datapoint::with('attributes')->get();

        // Inisialisasi centroids berdasarkan input pengguna
        $centroids = $this->initializeCentroids($initialCentroids, $datapoints);

        // Array untuk menyimpan hasil dari setiap iterasi
        $iterations = [];

        // Melakukan iterasi K-Means
        for ($i = 0; $i < 10; $i++) {
            // Membentuk cluster berdasarkan centroid yang ada
            $clusters = $this->assignClusters($datapoints, $centroids);

            // Menghitung centroid baru berdasarkan cluster
            $newCentroids = $this->updateCentroids($clusters);

            // Menyimpan hasil iterasi
            $iterations[] = ['clusters' => $clusters, 'centroids' => $newCentroids];

            // Menghentikan iterasi jika centroid tidak berubah
            if ($centroids == $newCentroids) break;
            $centroids = $newCentroids;
        }

        // Menampilkan hasil akhir clustering
        return view('clustering.result', compact('iterations', 'centroids', 'clusters'));
    }

    // Menginisialisasi centroid awal berdasarkan pilihan pengguna
    private function initializeCentroids($initialCentroids, $datapoints)
    {
        return Datapoint::whereIn('id', $initialCentroids)->with('attributes')->get();
    }

    // Menghitung jarak antara datapoint dan centroid, kemudian mengelompokkan datapoint ke cluster terdekat
    private function assignClusters($datapoints, $centroids)
    {
        $clusters = [];
        foreach ($datapoints as $datapoint) {
            $distances = [];
            foreach ($centroids as $centroid) {
                $distances[] = $this->calculateDistance($datapoint, $centroid);
            }
            $nearestCentroid = array_search(min($distances), $distances);
            $clusters[$nearestCentroid][] = $datapoint;
        }
        return $clusters;
    }

    // Memperbarui centroid berdasarkan rata-rata dari setiap cluster
    private function updateCentroids($clusters)
    {
        $newCentroids = [];
        foreach ($clusters as $cluster) {
            $centroid = $this->calculateCentroid($cluster); // centroid sebagai array
            $newCentroids[] = $centroid;
        }
        return $newCentroids;
    }

    // Menghitung jarak antara dua titik data menggunakan Euclidean Distance
    private function calculateDistance($datapoint, $centroid)
    {
        $sum = 0;
        foreach ($datapoint->attributes as $attribute) {
            // Ambil nilai dari centroid sebagai array, gunakan nilai default 0 jika atribut tidak ada
            $centroidValue = $centroid[$attribute->id] ?? 0;
            $sum += pow($attribute->pivot->value - $centroidValue, 2);
        }
        return sqrt($sum);
    }

    // Menghitung nilai rata-rata dari setiap atribut untuk menetapkan nilai centroid baru
    private function calculateCentroid($cluster)
    {
        $attributeSums = [];
        foreach ($cluster as $datapoint) {
            foreach ($datapoint->attributes as $attribute) {
                if (!isset($attributeSums[$attribute->id])) {
                    $attributeSums[$attribute->id] = 0;
                }
                $attributeSums[$attribute->id] += $attribute->pivot->value;
            }
        }

        // Hitung rata-rata dari setiap atribut sebagai nilai centroid baru
        $centroid = [];
        foreach ($attributeSums as $attributeId => $sum) {
            $centroid[$attributeId] = $sum / count($cluster);
        }

        return $centroid; // mengembalikan array nilai centroid baru
    }
}
