<?php
    namespace Jozef\Userapi\Http\Controllers;
    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;
    use RainLab\User\Models\User;
    
    // register new user
    class RegisterController {

        public function __invoke() {
            $name = post("name");
            $surname = post("surname");
            $email = post("email");
            $password = post("password");
            $password_confirmation = post("password_confirmation");
            $activation_code = $this->generateCode();

            $user = Auth::register([
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "password" => $password,
                "password_confirmation" => $password_confirmation
            ]);
            $user->activation_code = $activation_code;
            $user->save();

            return new UserResource($user);
        }

        // activate user
        function activate($id) {
            $user = User::findOrFail($id);
            $user->attemptActivation(post("activation_code"));
            return new UserResource($user);
        }

        // generate activation code for user
        private function generateCode() {
            $activation_code = "";

            for ($i = 0; $i < 6; $i++) {
                $activation_code = $activation_code . rand(0, 9);
            }

            return $activation_code;
        }

    };