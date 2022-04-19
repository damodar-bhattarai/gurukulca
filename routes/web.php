<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Routine;
use App\Models\RoutineClass;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Else_;

Route::get('/',function(){
    return redirect(route('login'),302);
});
// Route::get('test',function(){

//     $teachers=User::whereHas('roles',function($q){
//         $q->where('name','teacher');
//     })->get()->take(2);

//     $routines_today=Routine::where('routine_date',Date('Y-m-d'))->get();


//     foreach($teachers as $teacher){
//         $message='';
//         $batches=[];

//         $classes=RoutineClass::with('routine','routine.batch')->where('teacher_id',$teacher->id)
//         ->whereIn('routine_id',$routines_today->pluck('id')->toArray())
//         ->get();

//         //starting message (total classes for teacher today)
//       $message='You have '.$classes->count().' '. Str::plural('class', $classes->count()) ." today \r\n";

//         foreach($classes as $class){
//             if(!isset($batches[$class->routine->batch->name])){
//                 $batches[$class->routine->batch->name]=[];
//             }
//             $batches[$class->routine->batch->name][]=$class->order;
//         }

//         foreach($batches as $batch=>$classes){
//             $message.=$batch.': Class '.implode(', ',$classes)."\r\n";
//         }

//         Mail::raw($message, function ($message) use ($teacher) {
//             $message->to($teacher->email);
//             $message->subject('Today\'s Class');
//         });

//     }
// });


require __DIR__.'/auth.php';
