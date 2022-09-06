<?php
    namespace Jozef\Userapi\Http\Controllers;
    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;

    // login existing user
    class LoginController {
        function __invoke() {
            $user = Auth::authenticate([
                "email" => post("email"),
                "password" => post("password")
            ]);

            return new UserResource($user);
        }
    };