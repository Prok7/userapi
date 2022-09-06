<?php
    namespace Jozef\Userapi\Http\Controllers;
    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;

    class UpdateUserController {
        function __invoke() {
            $user = Auth::authenticate([
                "email" => post("old_email"),
                "password" => post("password")
            ]);
            $user->fill(post());
            $user->save();
            return new UserResource($user);
        }
    };