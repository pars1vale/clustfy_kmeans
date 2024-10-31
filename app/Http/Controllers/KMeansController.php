<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapoint;
use App\Models\Attribute;
use App\Models\Centroid;
use App\Models\ClusteringResult;

class KMeansController extends Controller
{
    public function index()
    {
        // Fetch all datapoints and attributes (for an empty initial state)
        $datapoints = Datapoint::all();
        $attributes = Attribute::all();

        // Set initial clustering and centroid data to empty arrays
        $iterations = [];
        $finalCentroids = [];

        return view('clustering.index', compact('datapoints', 'attributes', 'iterations', 'finalCentroids'));
    }

    public function startClustering(Request $request)
    {
        // Request input for number of clusters and initial centroid points
        $numClusters = $request->input('num_clusters');

        // Validate the input
        if (!$numClusters || $numClusters < 1) {
            return redirect()->back()->with('error', 'Please enter a valid number of clusters.');
        }

        // Fetch all datapoints to be clustered
        $datapoints = Datapoint::with('attributes')->get();

        // Initialize centroids manually based on user input
        $initialCentroids = $this->initializeCentroids($numClusters, $datapoints);

        // Run the K-Means clustering process
        list($iterations, $finalCentroids) = $this->performKMeansClustering($datapoints, $initialCentroids, $numClusters);

        // Redirect back to the clustering page with updated data
        return view('clustering.index', compact('datapoints', 'iterations', 'finalCentroids'));
    }

    private function initializeCentroids($numClusters, $datapoints)
    {
        $centroids = [];

        // Populate centroids based on user input (assuming manual selection for now)
        for ($i = 0; $i < $numClusters; $i++) {
            $centroids[$i] = []; // Placeholder to fill with user's chosen centroids for each attribute
        }

        return $centroids;
    }

    private function performKMeansClustering($datapoints, $initialCentroids, $numClusters)
    {
        $iterations = [];
        $centroids = $initialCentroids;
        $maxIterations = 100;

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            $clusters = [];

            // Step 1: Assign datapoints to the nearest centroid
            foreach ($datapoints as $datapoint) {
                $distances = [];

                foreach ($centroids as $index => $centroid) {
                    $distance = $this->calculateDistance($datapoint->attributes, $centroid);
                    $distances[$index] = $distance;
                }

                $closestCentroid = array_search(min($distances), $distances);
                $clusters[$closestCentroid][] = $datapoint;
            }

            // Step 2: Update centroids based on the mean of the clusters
            $newCentroids = $this->recalculateCentroids($clusters);

            // Check if centroids have stabilized
            if ($newCentroids == $centroids) {
                break;
            }

            $centroids = $newCentroids;
            $iterations[] = $clusters; // Store each iteration result for display
        }

        return [$iterations, $centroids];
    }

    private function calculateDistance($attributes, $centroid)
    {
        // Calculate distance between datapoint attributes and centroid
        $distance = 0;
        foreach ($attributes as $attribute) {
            $distance += pow($attribute->pivot->value - $centroid[$attribute->id], 2);
        }
        return sqrt($distance);
    }

    private function recalculateCentroids($clusters)
    {
        $newCentroids = [];

        foreach ($clusters as $index => $cluster) {
            if (count($cluster) > 0) {
                $centroid = [];
                $attributesCount = count($cluster[0]->attributes);

                foreach ($cluster as $datapoint) {
                    foreach ($datapoint->attributes as $attribute) {
                        $centroid[$attribute->id] = ($centroid[$attribute->id] ?? 0) + $attribute->pivot->value;
                    }
                }

                foreach ($centroid as $key => $totalValue) {
                    $centroid[$key] = $totalValue / count($cluster);
                }

                $newCentroids[$index] = $centroid;
            }
        }

        return $newCentroids;
    }
}
