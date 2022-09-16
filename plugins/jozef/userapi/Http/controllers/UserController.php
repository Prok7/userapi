<?php
    namespace Jozef\Userapi\Http\Controllers;
    use Jozef\Userapi\Http\Resources\UserResource;
    use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
    use RainLab\User\Models\User;

    class UserController {
        // update user based on new params in request
        function update() {
            $user = $this->getUser();
            $user->fill(post());
            $user->save();

            return new UserResource($user);
        }

        // delete user
        function delete() {
            $user = $this->getUser();
            $user->forceDelete();
            return response()->json(["message" => "User deleted",  new UserResource($user)]);
        }

        // show user based on id
        function show($id) {
            $user = User::find($id);
            return new UserResource($user);
        }

        // get user based on jwt passed in header
        private function getUser() {
            try {
                $user = auth()->userOrFail();
            } catch (UserNotDefinedException $e) {
                return response()->json(["error" => $e->getMessage()]);
            }

            return $user;
        }
    };