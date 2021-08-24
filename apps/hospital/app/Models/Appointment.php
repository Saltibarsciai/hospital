<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_date', 'patient_id'
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
