<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Support\Facades\Route;

    Route::group(['prefix'=>'backend','as'=>'backend.','middleware'=>'auth'],function () {

        Route::get('/',[DashboardController::class,'index'])->name('dashboard');

        Route::get('password',[DashboardController::class,'profile'])->name('user.password');
        Route::post('password',[DashboardController::class,'updateProfile'])->name('user.password.update');

        Route::get('user/edit/{id?}',[DashboardController::class,'editUser'])->name('user.edit');
        Route::put('user/update/{id}',[DashboardController::class,'updateUser'])->name('user.update');




        Route::middleware(['role:admin'])->group(function () {

            //user lists
            Route::get('users',[DashboardController::class,'users'])->name('user.index');
            Route::get('users/create',[DashboardController::class,'usersCreate'])->name('user.create');
        });

    });


