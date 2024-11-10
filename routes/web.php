<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DatapointController;
use App\Http\Controllers\KMeansController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Route::get('/chartjs', function () {
//     return view('chartjs');
// });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('attributes', AttributeController::class)->names('attributes');
Route::resource('datapoints', DatapointController::class)->names('datapoints');
Route::resource('users', UserController::class)->names('users')->only(['index']);



Route::get('/kmeans/select-cluster', [KMeansController::class, 'showClusterModal'])->name('kmeans.select_cluster');
Route::post('/kmeans/initialize-centroids', [KMeansController::class, 'initializeCentroids'])->name('kmeans.initialize_centroids');
// Route untuk tampilan iterasi
Route::post('/kmeans/cluster-iterations', [KMeansController::class, 'cluster'])->name('kmeans.cluster_iterations');

// Route untuk tampilan hasil akhir clustering
Route::get('/kmeans/result', [KMeansController::class, 'showFinalResult'])->name('kmeans.result');
