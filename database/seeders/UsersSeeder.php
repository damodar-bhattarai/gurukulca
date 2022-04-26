<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$super=Role::firstOrCreate(['name'=>'super']);
        $admin=Role::firstOrCreate(['name'=>'admin']);
        $teacher=Role::firstOrCreate(['name'=>'teacher']);
        $student=Role::firstOrCreate(['name'=>'student']);


        $sa1=User::firstOrCreate([
            'email' => env('APP_EMAIL','admin@example.com'),
        ], [
            'type'=>'admin',
            'name'=>'Admin',
            'email' => env('APP_EMAIL','admin@example.com'),
            'phone'=>'9825710275',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $sa1->assignRole($admin);
$sa1->assignRole($super);
    }
}
