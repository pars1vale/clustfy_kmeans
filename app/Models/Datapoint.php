<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapoint extends Model
{
    use HasFactory;
    protected $table = 'datapoint';
    protected $fillable = ['name', 'type'];

    // Relasi many-to-many dengan Attribute
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'datapoint_attribute')->withPivot('value');
    }
}
