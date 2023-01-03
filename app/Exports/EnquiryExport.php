<?php

namespace App\Exports;

use App\Models\Enquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnquiryExport implements FromCollection,WithHeadings,WithMapping
{
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Phone',
            'Message',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function map($enquiry): array
    {
         return[
             $enquiry->id,
             $enquiry->first_name.' '.$enquiry->last_name,
             $enquiry->email,
             $enquiry->phone,
             $enquiry->message,
             $enquiry->created_at,
             $enquiry->updated_at,
         ];
    }
    public function collection()
    {
        return Enquiry::all();
    }
}
