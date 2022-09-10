<?php
    namespace Jozef\Userapi\Http\Controllers;
    use Jozef\Userapi\Http\Resources\UserResource;
    use RainLab\User\Facades\Auth;

    class DeleteUserController {
        function __invoke() {
            try {
                $user = auth()->userOrFail();
            } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
                return response()->json(["error" => $e->getMessage()]);
            }
            $user->forceDelete();
            return new UserResource($user);
        }
    };