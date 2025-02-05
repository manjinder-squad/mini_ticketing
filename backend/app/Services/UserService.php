<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\IUserRepository;

class UserService
{
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle user signup.
     */
    public function signup($data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = $this->userRepository->createUser($data);

        $token = $user->createToken('TicketApp')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Handle user login.
     */
    public function login(array $data)
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user) {
            return null;
        }

        if(Auth::attempt(['email' => $user->email, 'password' => $data['password']])) {
            $user = Auth::user();
        } else {
            return null;
        }

        $token = $user->createToken('TicketApp')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Handle user logout.
     */
    public function logout($user)
    {
        // Revoke the user's current token
        $user->currentAccessToken()->delete();

        return [
            'message' => 'Successfully logged out'
        ];
    }
}
