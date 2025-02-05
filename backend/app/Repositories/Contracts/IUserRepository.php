<?php

namespace App\Repositories\Contracts;

interface IUserRepository
{
    /**
     * Create a new user.
     */
    public function createUser(array $data);

    /**
     * Find a user by email.
     */
    public function findByEmail(string $email);
}
