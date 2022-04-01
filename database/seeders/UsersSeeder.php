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
        $admin=Role::firstOrCreate(['name'=>'admin']);
        $branch=Role::firstOrCreate(['name'=>'branch']);
        $customer=Role::firstOrCreate(['name'=>'customer']);

        $address=Address::create([
            'district'=>'Kathmandu',
            'city'=>'Kathmandu',
            'street'=>'Kathmandu',
        ]);

        $person1=User::firstOrCreate([
            'email' => env('APP_EMAIL','admin@example.com'),
        ], [
            'name'=>'Central Branch',
            'email' => env('APP_EMAIL','admin@example.com'),
            'phone'=>'9801006432',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'address_id'=>$address->id,
        ]);

        $person1->assignRole($admin);
        $person1->assignRole($branch);
    }
}
