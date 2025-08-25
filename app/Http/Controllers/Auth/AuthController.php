<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService) {}

    /**
     * Log in a user and return a JWT token.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        
        $token = $this->authService->userLogin($request->validated());

        if ($token && $token->status) {
             return apiResponseWithStatusCode($token->data, 'success', $token->message, '', 200);
        }
        return apiResponseWithStatusCode([], 'error', $token['error'], '', 401);
       
    }

    /**
     * Log in a user and return a JWT token.a
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $logout = $this->authService->logout();
        if ($logout && $logout->status) {
            return apiResponseWithStatusCode([], 'success', 'You have successfully logged out', '', 200);
        }
        return apiResponseWithStatusCode([], 'error', $logout->message, '', 401);
    }
}
