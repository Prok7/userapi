<?php
    namespace Jozef\Userapi\Http\Controllers;
    use Jozef\Userapi\Http\Resources\UserResource;
    use RainLab\User\Facades\Auth;

    class UpdateUserController {
        function __invoke() {
            $payload = auth()->payload();
            $user = Auth::authenticate([
                "email" => $payload["email"],
                "password" => $payload["password"]
            ]);

            $user->fill(post());
            $user->save();
            
            return new UserResource($user);
        }
    };