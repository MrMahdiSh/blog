<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SampleWorkController;
use App\Http\Controllers\AuthVSauth;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use WpOrg\Requests\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get("/login", [AuthController::class, "login"])->name("login");

Route::get("/register", [AuthController::class, "register"])->name("register");

Route::get("/verify", [AuthController::class, "verify"])->name("verify");

Route::middleware("auth:api")->group(function () {

    // Post
    Route::get('/posts', [PostController::class, 'index']);

    Route::post('/posts', [PostController::class, 'store']);

    Route::get('/posts/{id}', [PostController::class, 'show']);

    Route::put('/posts/{id}', [PostController::class, 'update']);

    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    // Auth
    Route::get("/me", [AuthController::class, "me"]);

    Route::get("/refresh", [AuthController::class, "refresh"]);

    Route::get("/logout", [AuthController::class, "logout"]);
});
