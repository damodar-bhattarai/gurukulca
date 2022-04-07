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

            Route::get('routines',function(){
                return view('backend.livewire-pages.view-routine');
            })->name('routines.index');

            Route::get('routines/save/{routine_id?}',function($routine_id=null){
                return view('backend.livewire-pages.manage-routine',compact('routine_id'));
            })->name('routines.save');

            Route::get('subjects',function(){
                return view('backend.livewire-pages.subject');
            })->name('subjects');

            Route::get('batches',function(){
                return view('backend.livewire-pages.batch');
            })->name('batches');

            Route::get('admins',function(){
                return view('backend.livewire-pages.list-user',['type'=>'admin']);
            })->name('user.admins');

            Route::get('teachers',function(){
                return view('backend.livewire-pages.list-user',['type'=>'teacher']);
            })->name('user.teachers');

            Route::get('students',function(){
                return view('backend.livewire-pages.list-user',['type'=>'student']);
            })->name('user.students');

            Route::get('user/save',function(){
                return view('backend.livewire-pages.create-user');
            })->name('user.create');

        });

    });


