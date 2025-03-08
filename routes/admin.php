<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberPlanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::prefix("admin")->group(function () {
        Route::get("/dashboard", [BackendController::class, "dashboard"])->name("admin.dashboard");

        Route::prefix("member")->group(function () {
            Route::get("/", [MemberController::class, "index"])->name("admin.member.index");
            Route::get("/{id}", [MemberController::class, "show"])->name("admin.member.show");
        });

        Route::prefix("member-plan")->group(function () {
            Route::get("/{id}", [MemberPlanController::class, "show"])->name("admin.member-plan.show");
        });

        Route::prefix("trainer")->group(function () {
            Route::get("/", [TrainerController::class, "index"])->name("admin.trainer.index");
            Route::get("/create", [TrainerController::class, "create"])->name("admin.trainer.create");
            Route::post("/store", [TrainerController::class, "store"])->name("admin.trainer.store");
            Route::get("/edit/{id}", [TrainerController::class, "edit"])->name("admin.trainer.edit");
            Route::put("/update/{id}", [TrainerController::class, "update"])->name("admin.trainer.update");
            Route::delete("/destroy/{id}", [TrainerController::class, "destroy"])->name("admin.trainer.destroy");
        });

        Route::prefix("service")->group(function () {
            Route::get("/", [ServiceController::class, "index"])->name("admin.service.index");
            Route::get("/create", [ServiceController::class, "create"])->name("admin.service.create");
            Route::post("/store", [ServiceController::class, "store"])->name("admin.service.store");
            Route::get("/edit/{id}", [ServiceController::class, "edit"])->name("admin.service.edit");
            Route::put("/update/{id}", [ServiceController::class, "update"])->name("admin.service.update");
            Route::delete("/destroy/{id}", [ServiceController::class, "destroy"])->name("admin.service.destroy");
        });

        Route::prefix("service-detail")->group(function () {
            Route::get("/", [ServiceDetailController::class, "index"])->name("admin.service-detail.index");
            Route::get("/create", [ServiceDetailController::class, "create"])->name("admin.service-detail.create");
            Route::post("/store", [ServiceDetailController::class, "store"])->name("admin.service-detail.store");
            Route::get("/edit/{id}", [ServiceDetailController::class, "edit"])->name("admin.service-detail.edit");
            Route::put("/update/{id}", [ServiceDetailController::class, "update"])->name("admin.service-detail.update");
            Route::delete("/destroy/{id}", [ServiceDetailController::class, "destroy"])->name("admin.service-detail.destroy");
        });

        Route::prefix("room")->group(function () {
            Route::get("/", [RoomController::class, "index"])->name("admin.room.index");
            Route::get("/create", [RoomController::class, "create"])->name("admin.room.create");
            Route::post("/store", [RoomController::class, "store"])->name("admin.room.store");
            Route::get("/edit/{id}", [RoomController::class, "edit"])->name("admin.room.edit");
            Route::put("/update/{id}", [RoomController::class, "update"])->name("admin.room.update");
            Route::delete("/destroy/{id}", [RoomController::class, "destroy"])->name("admin.room.destroy");
        });

        Route::prefix("schedule")->group(function () {
            Route::get("/", [ScheduleController::class, "index"])->name("admin.schedule.index");
            Route::get("/create", [ScheduleController::class, "create"])->name("admin.schedule.create");
            Route::post("/store", [ScheduleController::class, "store"])->name("admin.schedule.store");
            Route::get("/{date}/show", [ScheduleController::class, "show"])->name("admin.schedule.show");
            Route::get("/edit/{id}", [ScheduleController::class, "edit"])->name("admin.schedule.edit");
            Route::put("/update/{id}", [ScheduleController::class, "update"])->name("admin.schedule.update");
            Route::delete("/destroy/{id}", [ScheduleController::class, "destroy"])->name("admin.schedule.destroy");
        });

        Route::prefix("transaction")->group(function () {
            Route::get("/", [TransactionController::class, "index"])->name("admin.transaction.index");
            Route::get("/show/{id}/detail", [TransactionController::class, "show"])->name("admin.transaction.show");
            Route::get("/create", [TransactionController::class, "create"])->name("admin.transaction.create");
            Route::post("/store", [TransactionController::class, "store"])->name("admin.transaction.store");
            Route::get("/edit/{id}", [TransactionController::class, "edit"])->name("admin.transaction.edit");
            Route::put("/update/{id}", [TransactionController::class, "update"])->name("admin.transaction.update");
            Route::delete("/destroy/{id}", [TransactionController::class, "destroy"])->name("admin.transaction.destroy");
        });

        Route::get("/change-password", [BackendController::class, "change_password"])->name("admin.change-password");
    });
});
