<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, "home"])->name("home");
Route::get('/about', [FrontendController::class, "about"])->name("about");
Route::get('/beautician', [FrontendController::class, "beautician"])->name("beautician");
Route::prefix("services")->group(function () {
    Route::get('/', [FrontendController::class, "services"])->name("services");
    Route::get('/{slug}', [FrontendController::class, "service_detail"])->name("service.detail");});
Route::get('/product', [FrontendController::class, "product"])->name("product");
Route::get('/checkout', [FrontendController::class, "checkout"])->name("checkout");


Route::middleware(["auth"])->group(function () {
    Route::middleware(["verified"])->group(function () {});

    Route::post("/membership", [MemberController::class, "checkout"])->name("member");
    Route::get("/membership/checkout", [FrontendController::class, "checkout"])->name("member.checkout");
    Route::post("/membership/checkout", [TransactionController::class, "store"])->name("member.checkout.post");
    Route::get("/payment/waiting/{invoice}", [FrontendController::class, "payment_waiting"])->name("payment.waiting");
    Route::post("/upload/proof", [TransactionController::class, "upload_proof"])->name("payment.upload.proof");

    include_once __DIR__ . "/admin.php";
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware(["guest"])->group(callback: function () {
    include_once __DIR__ . "/auth.php";
});

include_once __DIR__ . "/verify-email.php";
