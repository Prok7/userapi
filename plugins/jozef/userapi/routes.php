<?php
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