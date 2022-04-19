<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Imports\StudentsImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

    Route::group(['prefix'=>'backend','as'=>'backend.','middleware'=>'auth'],function () {

        Route::get('/',[DashboardController::class,'index'])->name('dashboard');

        Route::get('password',[DashboardController::class,'profile'])->name('user.password');
        Route::post('password',[DashboardController::class,'updateProfile'])->name('user.password.update');





        Route::middleware(['role:admin'])->group(function () {

            Route::get('user/edit/{id}',function($id){
                $user=User::findOrFail($id);
                $user_id=$user->id;
                return view('backend.livewire-pages.edit-user',compact('user_id'));
            })->name('user.edit');


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

            Route::get('students/bulk',function(){
                return view('backend.livewire-pages.bulk-student',);
            })->name('user.students.bulk');

            Route::post('students/bulk',function(Request $request){
                $request->validate([
                    'file'=>'required|mimes:xlsx,xls'
                ]);

                 Excel::import(new StudentsImport, $request->file('file'));

                return redirect()->route('backend.user.students.bulk')
                ->with('success','Students Imported successfully.');

            });

            Route::get('user/save',function(){
                return view('backend.livewire-pages.create-user');
            })->name('user.create');

        });

    });


