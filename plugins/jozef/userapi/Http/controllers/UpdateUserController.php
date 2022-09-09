<?php
    namespace Jozef\Userapi\Http\Controllers;
    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;

    class UpdateUserController {
        function __invoke() {
            try {
                $user = auth()->userOrFail();
            } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
                return response()->json(["error" => $e->getMessage()]);
            }
            $user->fill(post());
            $user->save();
            return $user;
        }
    };