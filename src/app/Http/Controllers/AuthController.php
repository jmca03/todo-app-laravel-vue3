<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{
    /**
     * Constructor
     * 
     * @param \App\Services\AuthService $service
     * @return void
     */
    public function __construct(protected AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * Login to the app.
     * 
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->service->login($request->toArray());
    }

    /**
     * Logout to the app.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->service->logout();
    }

    /**
     * Register an account.
     * 
     * @param \App\Http\Requests\RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        return $this->service->register($request->toArray());
    }
}
