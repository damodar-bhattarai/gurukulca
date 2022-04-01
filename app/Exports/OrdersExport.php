<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;



class OrdersExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $orders=Order::select('id','created_at','receiver_name','receiver_phone','receiver_email','receiver_address','cod','delivery_charge','product_name')->owned()->latest()->get();
        return $orders;
    }
    public function headings(): array
    {
        return [
            'Order Number',
            'Order Date',
            'Receiver Name',
            'Receiver Phone',
            'Receiver Email',
            'Receiver Address',
            'COD Amount',
            'Delivery Charge',
            'Product Name',
        ];
    }
}
