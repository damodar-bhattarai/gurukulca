<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class OrdersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function headingRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Order([
            'is_blank'=>0,
            'branch_id'=>auth()->user()->id,
            'created_by'=>auth()->user()->id,
            'order_date'=>date('Y-m-d'),
            'branch_name'=>auth()->user()->name,
            'receiver_name'=>$row['name'],
            'receiver_phone'=>$row['phone'],
            'receiver_email'=>$row['email'],
            'receiver_address'=>$row['address'],
            'product_name'=>$row['product_name'],
            'package_type'=>$row['package_type'],
            'delivery_instruction'=>$row['delivery_instruction'],
            'cod'=>$row['cod'],
            'delivery_charge'=>$row['delivery_charge'],
            'note'=>$row['note'],
        ]);
    }
}
