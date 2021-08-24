<?php


namespace App\Repository\UserRepository;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MysqlUserRepository implements UserRepositoryInterface
{

    public function store($data)
    {
        return User::create([
            'role_id' => $data['role'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
