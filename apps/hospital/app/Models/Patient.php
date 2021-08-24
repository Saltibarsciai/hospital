<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name', 'email'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function drugs()
    {
        return $this->belongsToMany(Drug::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
