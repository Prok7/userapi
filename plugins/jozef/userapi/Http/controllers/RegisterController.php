<?php
    namespace Jozef\Userapi\Http\Controllers;
    use RainLab\User\Facades\Auth;
    use Jozef\Userapi\Http\Resources\UserResource;
    
    // register new user
    class RegisterController {
        public function __invoke() {
            $name = post("name");
            $surname = post("surname");
            $email = post("email");
            $password = post("password");
            $password_confirmation = post("password_confirmation");
    
            $user = Auth::register([
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "password" => $password,
                "password_confirmation" => $password_confirmation
            ]);
    
            return new UserResource($user);
        }
    };