<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClusteringResult extends Model
{
    use HasFactory;
    protected $table = 'clustering_result';
    protected $fillable = ['datapoint_id', 'cluster_number'];
    // Relasi dengan Datapoint (Many to One)
    public function datapoint()
    {
        return $this->belongsTo(Datapoint::class, 'datapoint_id');
    }

    // Relasi dengan Centroid (Many to One)
    public function centroid()
    {
        return $this->belongsTo(Centroid::class, 'cluster_id');
    }
}
