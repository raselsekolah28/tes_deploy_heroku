<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return redirect()->route("login");
});

Route::prefix("auth")->group(function() {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/login", [AuthController::class, "storeLogin"])->name("storeLogin");
    Route::post("/register", [AuthController::class, "storeRegister"])->name("storeRegister");
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::prefix("dashboard")->group(function() {
    Route::middleware(['auth'])->group(function () {
        Route::get("/", [DashboardController::class, "dashboard"])->name("dashboard");

        Route::middleware(['admin'])->group(function () {
            Route::resource('products', ProductController::class);

            Route::prefix("transactions")->group(function() {
                Route::get("/", [TransactionController::class, "index"])->name("transaction.index");
            });

            Route::prefix("users")->group(function() {
                Route::get("/", [UserController::class, "index"])->name("users.index");
            });
        });

        Route::middleware(['customer'])->group(function () {
            Route::get("/products/{id}/detail", [ProductController::class, "show"])->name("products.detail");

            Route::prefix("cart")->group(function() {
                Route::post("/{id}/add", [CartController::class, "add"])->name("cart.add");
            });

            Route::prefix("checkout")->group(function() {
                Route::get("/", [CheckoutController::class, "index"])->name("checkout.index");
                Route::post("/", [CheckoutController::class, "store"])->name("checkout.store");
            });
        });
    });
});