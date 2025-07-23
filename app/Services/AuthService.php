<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{

    /**
     * Log in a user and return a JWT token.
     *
     * @param array $credentials
     * @return string
     * @throws \Exception
     */
    public function userLogin(array $credentials): array
    {

        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return ['error' => 'Invalid Credentials'];
        }

        return $this->withJwTToken(['token' => $token]);
    }


    /**
     * Logout user
     * 
     */
    public function logout(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }


    /**
     * Bind extra details
     */
    private function withJwTToken(array $data): array
    {
        $data['expires_in'] = JWTAuth::factory()->getTTL() * 120;  // set on env later
        $data['token_type'] = 'Bearer';
        $data['user'] = JWTAuth::user();
        return $data;
    }
}
