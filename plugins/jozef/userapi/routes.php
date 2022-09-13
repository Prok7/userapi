<?php

    use Jozef\Userapi\Http\Controllers\RegisterController;
    use Jozef\Userapi\Http\Controllers\JWTController;
    use Jozef\Userapi\Http\Controllers\ResetPassController;
    use Jozef\Userapi\Http\Controllers\ShowUserController;
    use Jozef\Userapi\Http\Controllers\UpdateUserController;
    use Jozef\Userapi\Http\Controllers\DeleteUserController;

    Route::group(["prefix" => "api"], function() {

        // routes that need authentication (email and password)
        Route::group([
            "prefix" => "auth"
        ], function() {
            Route::post("register", RegisterController::class);
            Route::post("login", [JWTController::class, "login"]);
            Route::post("reset/password", ResetPassController::class);
        });

        // get user info based on id
        Route::match(["post", "get"], "users/{id}", ShowUserController::class);

        // routes that are just for logged users
        Route::group(["middleware" => Tymon\JWTAuth\Http\Middleware\Authenticate::class], function() {
            Route::post("update/user", UpdateUserController::class);
        });
        Route::delete("delete/user", DeleteUserController::class);
        Route::get("jwt/refresh", [JWTController::class, "refreshJWT"]);
        Route::get("jwt/invalidate", [JWTController::class, "invalidateJWT"]);

    });