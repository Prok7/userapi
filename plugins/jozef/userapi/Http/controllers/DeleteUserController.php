<?php
    namespace Jozef\Userapi\Http\Controllers;
    use Jozef\Userapi\Http\Resources\UserResource;
    use RainLab\User\Facades\Auth;

    class DeleteUserController {
        function __invoke() {
            $user = Auth::authenticate([
                "email" => post("email"),
                "password" => post("password")
            ]);
            $user->forceDelete();
            return new UserResource($user);
        }
    };