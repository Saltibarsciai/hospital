<?php

namespace App\Models;

use App\Notifications\ResetHospital;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use CanResetPassword;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetHospital($token));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isDoctor()
    {
        return $this->role_id === config('roles.doctor');
    }

    public function isReceptionist()
    {
        return $this->role_id === config('roles.receptionist');
    }

//    public function userable()
//    {
//        return $this->morphTo();
//    }
//    public function doctor()
//    {
//        return $this->hasOne(Doctor::class);
//    }
//    public function patient()
//    {
//        return $this->hasOne(Patient::class);
//    }


    #public function user()
    #{
    #    return $this->belongsTo(User::class);
    #}
    #public function users()
    #{
    #    return $this->hasMany(User::class);
    #}
}
