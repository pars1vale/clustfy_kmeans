<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DatapointController;
use App\Http\Controllers\KMeansController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/chartjs', function () {
//     return view('chartjs');
// });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('attributes', AttributeController::class)->names('attributes');
Route::resource('datapoints', DatapointController::class)->names('datapoints');

Route::get('/clustering', [KMeansController::class, 'index'])->name('clustering.index');
Route::post('/clustering/process', [KMeansController::class, 'processClustering'])->name('clustering.process');
