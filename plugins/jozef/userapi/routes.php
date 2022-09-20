<?php
    use Jozef\Userapi\Http\Controllers\RegisterController;
    use Jozef\Userapi\Http\Controllers\JWTController;
    use Jozef\Userapi\Http\Controllers\ResetPassController;
    use Jozef\Userapi\Http\Controllers\UserController;

    Route::group(["prefix" => "api"], function() {

        // routes that need authentication (email and password)
        Route::group([
            "prefix" => "auth"
        ], function() {
            Route::post("register", RegisterController::class);
            Route::post("login", [JWTController::class, "login"]);
            Route::post("reset/password", ResetPassController::class);
            Route::post("activate", [RegisterController::class, "activate"]);
        });

        // get user info based on id
        Route::match(["post", "get"], "users/{id}", [UserController::class, "show"]);

        // routes that are just for logged users
        Route::group(["middleware" => "auth"], function() {
            Route::post("update/user", [UserController::class, "update"]);
            Route::delete("delete/user", [UserController::class, "delete"]);
            Route::get("jwt/refresh", [JWTController::class, "refreshJWT"]);
            Route::get("jwt/invalidate", [JWTController::class, "invalidateJWT"]);
        });

    });