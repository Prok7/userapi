<?php
    namespace Jozef\Userapi\Http\Controllers;
    use Jozef\Userapi\Http\Resources\UserResource;
    use RainLab\User\Models\User;

    class ShowUserController {
        function __invoke($id) {
            $user = User::find($id);
            return new UserResource($user);
        }
    };