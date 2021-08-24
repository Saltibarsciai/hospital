<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = [
        'name'
    ];

    public function drugs()
    {
        return $this->belongsToMany(Prescription::class);
    }
}
