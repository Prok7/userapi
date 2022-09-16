<?php
    namespace Jozef\Userapi\Http\Controllers;
    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;

    // reset forgotten password
    class ResetPassController {
        function __invoke() {
            $user = Auth::authenticate([
                "email" => post("email"),
                "password" => post("password")
            ]);

            $user->password = post("new_password");
            $user->password_confirmation = post("new_password_confirmation");
            $user->save();

            return response()->json(["message" => "Password resetted", new UserResource($user)]);
        }
    };