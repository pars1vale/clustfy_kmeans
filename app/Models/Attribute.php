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
}
