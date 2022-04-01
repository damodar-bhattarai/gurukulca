<?php

namespace Tests\Feature;

use App\Services\ShipmentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShipmentChargeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
       $parcels=[
           ['name' => 'parcel_1', 'quantity' => 1, 'length' => 10, 'breadth' => 20, 'height' => 30, 'weight' => 2],
           ['name' => 'parcel_1', 'quantity' => 3, 'length' => 15, 'breadth' => 10, 'height' => 20, 'weight' => 1],
       ];
       $type="parcel";
       $location_type="country";
       $location_name="india";

       $shipmentService=new ShipmentService();
       $charge=$shipmentService->getShippingPrice($type,$parcels,$location_type,$location_name);


    }
}
