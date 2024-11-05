<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attribute';
    protected $fillable = ['name', 'description'];

    // Relasi many-to-many dengan Datapoint
    public function datapoints()
    {
        return $this->belongsToMany(Datapoint::class, 'datapoint_attribute')->withPivot('value');
    }
    // Relasi many-to-many dengan Centroid
    public function centroids()
    {
        return $this->belongsToMany(Centroid::class, 'centroid_attributes')->withPivot('value');
    }
}
