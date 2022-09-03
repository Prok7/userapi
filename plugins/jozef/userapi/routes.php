<?php
    use RainLab\User\Models\User;
    use Jozef\Userapi\Http\Resources\UserResource;

    // register new user
    Route::post("api/register", function() {
        $name = post("name");
        $surname = post("surname");
        $email = post("email");
        $password = post("password");
        $password_confirmation = post("password_confirmation");

        Auth::register([
            "name" => $name,
            "surname" => $surname,
            "email" => $email,
            "password" => $password,
            "password_confirmation" => $password_confirmation
        ]);

        return "User created";
    });

    // login existing user
    Route::post("api/login", function() {
        $user = Auth::authenticate([
            "email" => post("email"),
            "password" => post("password")
        ]);
        return $user;
    });

    // reset forgotten password
    Route::post("api/reset/password", function() {
        $user = Auth::authenticate([
            "email" => post("email"),
            "password" => post("password")
        ]);
        $user->password = post("new_password");
        $user->password_confirmation = post("new_password_confirmation");
        $user->save();
        return "Password resetted successfully";
    });

    // update user info
    Route::post("api/update/user", function() {
        $user = Auth::authenticate([
            "email" => post("email"),
            "password" => post("password")
        ]);

        $changed = [];
        $user_info = ["email", "name", "surname"];
        foreach ($user_info as $info) {
            if (post("new_$info")) {
                $user->$info = post("new_$info");
                array_push($changed, $info);
            };
        };

        if (count($changed) > 0) {
            $user->save();
            return "Info has been successfully changed";
        } else {
            return "No info has been changed";
        }
    });

    // show user info
    Route::post("api/show/user", function() {
        $user = User::find(post("id"));
        return new UserResource($user);
    });

    // delete user
    Route::post("api/delete/user", function() {
        $user = Auth::authenticate([
            "email" => post("email"),
            "password" => post("password")
        ]);
    
        $user->delete();
        return "User deactivated";
    });