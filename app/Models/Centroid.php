<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centroid extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'centroid_attributes')->withPivot('value');
    }
}
