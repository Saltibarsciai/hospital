<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'patient_id', 'instructions'
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function drugs()
    {
        return $this->belongsToMany(Drug::class);
    }
}
