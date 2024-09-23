<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attribute';
    protected $fillable = ['name', 'description'];
    public function datapoints()
    {
        return $this->hasMany(Datapoint::class, 'attribute_id');
    }
}
