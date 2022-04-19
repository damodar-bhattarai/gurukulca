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
//     try {
//         $message = 'You have 6 '. Str::plural('class', 6) . " today \r\n";
//         $message .= 'Batch 1 : Class 1,2,3' . "\r\n";
//         $message .= 'Batch 2 : Class 4,5,6' . "\r\n";


//         $response = Http::get('https://smsprima.com/api/api/index', [
//             'username' => 'sajesh',
//             'password' => '123456789',
//             'sender' => 'DigitalSMS',
//             'destination' => '9825710275',
//             'type' => 1,
//             'message' => $message
//         ]);
//         Log::info('SMS Success: ' . $response->body());
//     } catch (\Exception $e) {
//         Log::error('SMS Error: ' . $e->getMessage());
//     }
// });


require __DIR__.'/auth.php';
