<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DatapointController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\KMeansController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
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
Route::post('/kmeans/cluster-iterations', [KMeansController::class, 'cluster'])->name('kmeans.cluster_iterations');
// Route::get('/kmeans/result', [KMeansController::class, 'showFinalResult'])->name('kmeans.result');

Route::get('/attribute-pdf', [PDFController::class, 'attributePDF'])->name('attribute_pdf');
Route::get('/datapoint-pdf', [PDFController::class, 'datapointPDF'])->name('datapoint_pdf');
Route::resource('attributes', AttributeController::class)->names('attributes');
Route::resource('datapoints', DatapointController::class)->names('datapoints');
Route::resource('users', UserController::class)->names('users')->only(['index']);


Route::get('/kmeans/select-cluster', [KMeansController::class, 'showClusterModal'])->name('kmeans.select_cluster');
Route::post('/kmeans/initialize-centroids', [KMeansController::class, 'initializeCentroids'])->name('kmeans.initialize_centroids');
Route::post('/kmeans/cluster-iterations', [KMeansController::class, 'cluster'])->name('kmeans.cluster_iterations');
// Route::get('/kmeans/result', [KMeansController::class, 'showFinalResult'])->name('kmeans.result');

Route::get('/attribute-pdf', [PDFController::class, 'attributePDF'])->name('attribute_pdf');
Route::get('/datapoint-pdf', [PDFController::class, 'datapointPDF'])->name('datapoint_pdf');
Route::get('/landscape-pdf', [PDFController::class, 'lanscapePdfTest'])->name('landscapePDF');

Route::get('attribute/export/excel', [ExcelExportController::class, 'export'])->name('attribute.export.excel');
Route::get('datapoint/export/excel', [ExcelExportController::class, 'exportDatapoint'])->name('datapoint.export.excel');
