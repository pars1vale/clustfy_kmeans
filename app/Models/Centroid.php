<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centroid extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'centroid';

    // Field yang bisa diisi
    protected $fillable = ['datapoint_id', 'value1', 'value2'];

    // Relasi dengan Datapoint (Many to One)
    public function datapoint()
    {
        return $this->belongsTo(Datapoint::class, 'datapoint_id');
    }

    // Relasi dengan ClusteringResult (One to Many)
    public function clusteringResults()
    {
        return $this->hasMany(ClusteringResult::class);
    }
}
