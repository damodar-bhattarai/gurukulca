<?php

namespace App\Console;

use App\Models\Routine;
use App\Models\RoutineClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $todayRoutine=Routine::with('classes')->where('routine_date','=',Date('Y-m-d'))->first();
            if($todayRoutine){
                $classes=$todayRoutine->classes;
                $classesId=$classes->pluck('id')->toArray();

                $teachers=User::whereHas('roles',function($q){
                    $q->where('name','teacher');
                })->get();

                foreach($teachers as $teacher){
                    $class=RoutineClass::whereIn('id',$classesId)->where('teacher_id',$teacher->id)->get();
                    if($class->count()){
                        $response= Http::get('https://smsprima.com/api/api/index',[
                            'username'=>'sajesh',
                            'password'=>'123456789',
                            'sender'=>'DigitalSMS',
                            'destination'=>$teacher->phone,
                            'type'=>1,
                            'message'=>'You have '.$class->count().' '. Str::plural('class', $class->count()) .' today. Class '.$class->pluck('order')->implode(', ')
                        ]);
                        //log response
                        Log::info('Triggered SMS to '.$teacher->name.' at '.$teacher->phone);
                        Log::info('SMS Response: '.$response->body());
                    }
                }
            }

        })->timezone('Asia/Kathmandu')->dailyAt('04:00')->runInBackground();

        $schedule->call(function(){
            $todayRoutine=Routine::with('classes')->where('routine_date','=',Date('Y-m-d'))->first();
            if($todayRoutine){
                $classes=$todayRoutine->classes;
                $classesId=$classes->pluck('id')->toArray();

                $teachers=User::whereHas('roles',function($q){
                    $q->where('name','teacher');
                })->get();

                foreach($teachers as $teacher){
                    $class=RoutineClass::whereIn('id',$classesId)->where('teacher_id',$teacher->id)->get();
                    if($class->count()){
                        Mail::raw('You have '.$class->count().' '. Str::plural('class', $class->count()) .' today. Class '.$class->pluck('order')->implode(', '), function ($message) use ($teacher) {
                            $message->to($teacher->email);
                            $message->subject('Today\'s Class');
                        });
                        //log response
                        Log::info('Triggered Email to '.$teacher->name.' at '.$teacher->phone);

                    }
                }
            }

        })->timezone('Asia/Kathmandu')->everyFifteenMinutes()->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
