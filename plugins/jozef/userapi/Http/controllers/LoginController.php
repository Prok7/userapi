<?php
    namespace Jozef\Userapi\Http\Controllers;

    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;

    // login existing user
    class LoginController {
        function __invoke() {
            $credentials = request(["email", "password"]);
            $token = auth()->attempt($credentials);
            if ($token === false) {
                return response()->json(["error" => "Wrong email or password"]);
            }
            return response()->json([
                "token" => $token,
                "token_type" => "bearer",
                "expires_in" => config("jwt.ttl")
            ]);
        }
    };