<?php

namespace App\Exports;

use App\Models\Ehundi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EhundiExport implements FromCollection,WithHeadings,WithMapping
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
    public function map($ehundi): array
    {
         return[
             $ehundi->id,
             $ehundi->first_name.' '.$ehundi->last_name,
             $ehundi->email,
             $ehundi->phone,
             $ehundi->city,
             $ehundi->state,
             $ehundi->pan,
             $ehundi->trust==1 ? 'Sai Mayee trust' : 'Sri Sai Meru Mathi Trust',
             $ehundi->amount,
             $ehundi->created_at,
             $ehundi->updated_at,
         ];
    }
    public function collection()
    {
        return Ehundi::all();
    }
}
