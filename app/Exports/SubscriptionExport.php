<?php

namespace App\Exports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubscriptionExport implements FromCollection,WithHeadings,WithMapping
{
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Phone',
            'Ebook',
            'Event',
            'Newsletter',
            'Blog',
            'Crossword',
            'Status',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function map($user): array
    {
         return[
             $user->id,
             $user->name,
             $user->email,
             $user->phone,
             $user->ebook==1 ? 'Yes' : 'No',
             $user->event==1 ? 'Yes' : 'No',
             $user->newsletter==1 ? 'Yes' : 'No',
             $user->blog==1 ? 'Yes' : 'No',
             $user->crossword==1 ? 'Yes' : 'No',
             $user->created_at,
             $user->updated_at,
         ];
    }
    public function collection()
    {
        return Subscription::all();
    }
}
