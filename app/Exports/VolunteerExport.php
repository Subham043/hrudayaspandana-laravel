<?php

namespace App\Exports;

use App\Models\Volunteer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VolunteerExport implements FromCollection,WithHeadings,WithMapping
{
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Phone',
            'Aadhar',
            'Address',
            'Interest',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function map($volunteer): array
    {
         return[
             $volunteer->id,
             $volunteer->first_name.' '.$volunteer->last_name,
             $volunteer->email,
             $volunteer->phone,
             $volunteer->aadhar,
             $volunteer->address,
             $volunteer->interest,
             $volunteer->created_at,
             $volunteer->updated_at,
         ];
    }
    public function collection()
    {
        return Volunteer::all();
    }
}
