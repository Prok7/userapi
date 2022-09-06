<?php

use RainLab\User\Models\User;
    use Jozef\Userapi\Http\Resources\UserResource;

    use Jozef\Userapi\Http\Controllers\RegisterController;
    use Jozef\Userapi\Http\Controllers\LoginController;
    use Jozef\Userapi\Http\Controllers\ResetPassController;
    use Jozef\Userapi\Http\Controllers\ShowUserController;
    use Jozef\Userapi\Http\Controllers\UpdateUserController;
    use Jozef\Userapi\Http\Controllers\DeleteUserController;

    Route::group(["prefix" => "api"], function() {
        // routes that need authentication
        Route::group(["prefix" => "auth"], function() {
            Route::post("register", RegisterController::class);
            Route::post("login", LoginController::class);
            Route::post("reset/password", ResetPassController::class);
        });

        Route::match(["post", "get"], "users/{id}", ShowUserController::class);

        // routes that will be based on jwt soon
        Route::post("update/user", UpdateUserController::class);
        Route::post("delete/user", DeleteUserController::class);
    });