<?php

namespace App\Repository\DoctorRepository;

use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorMysqlRepository implements DoctorRepositoryInterface
{
    public function store($data)
    {
         return Doctor::create([
            'role_id' => $data['role'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
