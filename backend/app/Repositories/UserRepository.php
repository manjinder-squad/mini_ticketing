<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;

class UserRepository implements IUserRepository
{
    /**
     * Create a new user.
     */
    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    /**
     * Find a user by email.
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
