<?php


namespace App\Repository\ReceptionistRepository;


use App\Models\Receptionist;
use Illuminate\Support\Facades\Hash;

class ReceptionistMysqlRepository implements ReceptionistRepositoryInterface
{
    public function store($data)
    {
        return Receptionist::create([
            'role_id' => $data['role'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
