<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle user signup.
     */
    public function signup(SignupRequest $request)
    {
        try {
            $result = $this->userService->signup($request->validated());

            return $this->sendResponse($result, 'User register successfully.', 201);

        } catch (\Exception $e) {
            return $this->sendError('Internal error.', [$e->getMessage()], 500);
        }
    }

    /**
     * Handle user login.
     */
    public function login(LoginRequest $request)
    {
        try {
            $result = $this->userService->login($request->validated());

            if ($result === null) {
                return $this->sendError('Invalid credentials.', [], 401);
            }

            return $this->sendResponse($result, 'User logged in successfully.', 200);
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return $this->sendError('Internal error.', [$e->getMessage()], 500);
        }
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        try {
            $this->userService->logout($request->user());

            return $this->sendResponse([], 'Successfully logged out', 200);
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return $this->sendError('Internal error.', [$e->getMessage()], 500);
        }
    }
}
