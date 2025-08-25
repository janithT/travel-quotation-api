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
    public function userLogin(array $credentials): object
    {

        try {
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                throw new \Illuminate\Auth\AuthenticationException("Invalid credentials.");
            }

            $data = $this->withJwTToken(['token' => $token]);

            return apiServiceResponse($data, true, 'Login success');

        } catch (\Exception $e) {
            return apiServiceResponse([], false, $e->getMessage());
        }
    }


    /**
     * Logout user
     * 
     */
    public function logout(): Object
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return apiServiceResponse([], true, 'Logot success');

        } catch (\Exception $e) {
            return apiServiceResponse([], false, $e->getMessage());
        }
        
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
