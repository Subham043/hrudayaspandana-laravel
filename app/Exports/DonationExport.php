<?php

namespace App\Exports;

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DonationExport implements FromCollection,WithHeadings,WithMapping
{
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Phone',
            'City',
            'State',
            'Pan',
            'Trust',
            'Amount',
            'Status',
            'Order ID',
            'Receipt',
            'Payment ID',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function map($donation): array
    {
         return[
             $donation->id,
             $donation->first_name.' '.$donation->last_name,
             $donation->email,
             $donation->phone,
             $donation->city,
             $donation->state,
             $donation->pan,
             $donation->trust==1 ? 'Sai Mayee trust' : 'Sri Sai Meru Mathi Trust',
             $donation->amount,
             $donation->status==1 ? 'Payment Success' : 'Payment Pending',
             $donation->order_id,
             $donation->receipt,
             $donation->payment_id,
             $donation->created_at,
             $donation->updated_at,
         ];
    }
    public function collection()
    {
        return Donation::all();
    }
}
