<?php
    namespace Jozef\Userapi\Http\Controllers;

    // jwt controller
    class JWTController {
        // login user
        function login() {
            $credentials = request(["email", "password"]);
            $token = auth()->attempt($credentials);

            if ($token === false) {
                return response()->json(["error" => "Wrong email or password"]);
            }
            
            return $this->respondWithToken($token);
        }

        // refresh jwt
        function refreshJWT() {
            $newToken = auth()->refresh();
            return $this->respondWithToken($newToken);
        }

        // invalidate jwt
        function invalidateJWT() {
            auth()->invalidate();
            return response()->json(["message" => "Token invalidated"]);
        }

        // respond json array with jwt info
        private function respondWithToken($token) {
            return response()->json([
                "token" => $token,
                "token_type" => "bearer",
                "expires_in" => config("jwt.ttl")
            ]);
        }
    };