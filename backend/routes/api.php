<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Root API
Route::group(["prefix" => "tree"], function () {

    // ======= PUBLIC API =======
    // Viết Public API từ đây (Public API: Là những API KHÔNG YÊU CẦU xác thực người dùng để trả về dữ liệu)
    Route::group(["prefix" => "auth"], function () {
        Route::controller(UserController::class)->group(function () {
            Route::post("register", "register")->name("register");
            Route::post("login", "login");
            Route::get("forgot-password", "forgotPassword");
            Route::post("reset-password", "resetPassword");
            Route::post("refresh-token", "refreshToken");
            Route::get("verify-account", "verifyAccount");
            Route::post("create-verify-token", "createVerifyToken");
        });
    });
    Route::middleware('auth:api')->get('/user', [UserController::class, 'me']);
    Route::group(["prefix" => "client"], function () {

    });

    // ======= PRIVATE API =======
    Route::group(["middleware" => ["auth:api"]], function () {
        Route::group(["prefix" => "auth"], function () {
            Route::controller(UserController::class)->group(function () {
                Route::get("profile", "profile");
                Route::post("logout", "logout");
                Route::post("change-password", "changePassword");
            });
        });

        Route::group(["prefix" => "admin"], function () {

        });
        Route::group(["prefix" => "client"], function () {

        });
        Route::group(["prefix" => "file"], function () {
            // Route::controller(ImageController::class)->group(function () {
            //     Route::post("upload_image", "uploadImage");
            //     Route::delete("remove_image", "removeImage");
            // });
        });
    });
});
