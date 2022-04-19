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
        $schedule->call(function () {

            $teachers = User::whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })->get()->take(2);

            $routines_today = Routine::where('routine_date', Date('Y-m-d'))->get();

            foreach ($teachers as $teacher) {
                $message = '';
                $batches = [];

                $classes = RoutineClass::with('routine', 'routine.batch')->where('teacher_id', $teacher->id)
                    ->whereIn('routine_id', $routines_today->pluck('id')->toArray())
                    ->get();

                //starting message (total classes for teacher today)
                $message = 'You have ' . $classes->count() . ' ' . Str::plural('class', $classes->count()) . " today \r\n";

                foreach ($classes as $class) {
                    if (!isset($batches[$class->routine->batch->name])) {
                        $batches[$class->routine->batch->name] = [];
                    }
                    $batches[$class->routine->batch->name][] = $class->order;
                }

                foreach ($batches as $batch => $classes) {
                    $message .= $batch . ': Class ' . implode(', ', $classes) . "\r\n";
                }

                Log::info('Triggered SMS to ' . $teacher->name . ' at ' . $teacher->phone);
                try {
                    $response = Http::get('https://smsprima.com/api/api/index', [
                        'username' => 'sajesh',
                        'password' => '123456789',
                        'sender' => 'DigitalSMS',
                        'destination' => $teacher->phone,
                        'type' => 1,
                        'message' => $message
                    ]);
                    Log::info('SMS Success: ' . $response->body());
                } catch (\Exception $e) {
                    Log::error('SMS Error: ' . $e->getMessage());
                }
            }
        })->timezone('Asia/Kathmandu')->dailyAt('04:00')->runInBackground();

        $schedule->call(function () {

            $teachers = User::whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })->get()->take(2);

            $routines_today = Routine::where('routine_date', Date('Y-m-d'))->get();

            foreach ($teachers as $teacher) {
                $message = '';
                $batches = [];

                $classes = RoutineClass::with('routine', 'routine.batch')->where('teacher_id', $teacher->id)
                    ->whereIn('routine_id', $routines_today->pluck('id')->toArray())
                    ->get();

                //starting message (total classes for teacher today)
                $message = 'You have ' . $classes->count() . ' ' . Str::plural('class', $classes->count()) . " today \r\n";

                foreach ($classes as $class) {
                    if (!isset($batches[$class->routine->batch->name])) {
                        $batches[$class->routine->batch->name] = [];
                    }
                    $batches[$class->routine->batch->name][] = $class->order;
                }

                foreach ($batches as $batch => $classes) {
                    $message .= $batch . ': Class ' . implode(', ', $classes) . "\r\n";
                }

                Log::info('Triggered Email to ' . $teacher->name . ' at ' . $teacher->email);
                try {
                   Mail::raw($message, function ($message) use ($teacher) {
                        $message->to($teacher->email);
                        $message->subject('Class Routine ' . Date('Y-m-d'));
                    });
                    Log::info('Mail Success: ' . $message));
                } catch (\Exception $e) {
                    Log::error('Mail Error: ' . $e->getMessage());
                }
            }
        })->timezone('Asia/Kathmandu')->everyMinute()->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
