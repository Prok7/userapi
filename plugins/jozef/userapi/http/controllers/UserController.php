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
            return new UserResource($user);
        }

        // show user based on id
        function show($id) {
            $user = User::find($id);
            return new UserResource($user);
        }

        // activate user
        function activate() {
            $user = User::where("email", post("email"))->first();
            $elapsed_time = now()->diffInSeconds($user->sent_code_at) / 60; // in minutes

            if ($elapsed_time < config("activation_code_ttl")) {
                $user->attemptActivation(post("activation_code"));
                return new UserResource($user);
            } else {
                return response()->json(["error" => "Activation code has expired"]);
            }
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