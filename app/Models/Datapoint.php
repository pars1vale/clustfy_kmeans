<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapoint extends Model
{
    use HasFactory;
    protected $table = 'datapoint';
    protected $fillable = ['name', 'type', 'attribute_id'];
    // Relasi dengan Attribute (Many to One)
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    // Relasi dengan Centroid (One to Many)
    public function centroids()
    {
        return $this->hasMany(Centroid::class);
    }

    // Relasi dengan ClusteringResult (One to Many)
    public function clusteringResults()
    {
        return $this->hasMany(ClusteringResult::class);
    }
}
