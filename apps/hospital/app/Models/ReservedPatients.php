<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservedPatients extends Model
{
    protected $fillable = [
      'user_id', 'patient_id'
    ];
}
