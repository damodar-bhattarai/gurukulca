<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::created([
            'name'=>'Service-1',
            'slug'=>'service-1',
            'description'=>"Service descriptions are like product descriptions. But instead of describing tangible goods, you're describing the services that you provide, including what you do, some basics about how you do it and why people should care about the service. Service descriptions are like product descriptions.Service descriptions are like product descriptions. But instead of describing tangible goods, you're describing the services that you provide, including what you do, some basics about how you do it and why people should care about the service. Service descriptions are like product descriptions."
        ]);
        Service::created([
            'name'=>'Service-2',
            'slug'=>'service-2',
            'description'=>"Service descriptions are like product descriptions. But instead of describing tangible goods, you're describing the services that you provide, including what you do, some basics about how you do it and why people should care about the service. Service descriptions are like product descriptions.Service descriptions are like product descriptions. But instead of describing tangible goods, you're describing the services that you provide, including what you do, some basics about how you do it and why people should care about the service. Service descriptions are like product descriptions."
        ]);
        Service::created([
            'name'=>'Service-3',
            'slug'=>'service-3',
            'description'=>"Service descriptions are like product descriptions. But instead of describing tangible goods, you're describing the services that you provide, including what you do, some basics about how you do it and why people should care about the service. Service descriptions are like product descriptions.Service descriptions are like product descriptions. But instead of describing tangible goods, you're describing the services that you provide, including what you do, some basics about how you do it and why people should care about the service. Service descriptions are like product descriptions."
        ]);
    }
}
