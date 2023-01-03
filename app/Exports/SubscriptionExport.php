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
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function map($subscription): array
    {
         return[
             $subscription->id,
             $subscription->name,
             $subscription->email,
             $subscription->phone,
             $subscription->ebook==1 ? 'Yes' : 'No',
             $subscription->event==1 ? 'Yes' : 'No',
             $subscription->newsletter==1 ? 'Yes' : 'No',
             $subscription->blog==1 ? 'Yes' : 'No',
             $subscription->crossword==1 ? 'Yes' : 'No',
             $subscription->created_at,
             $subscription->updated_at,
         ];
    }
    public function collection()
    {
        return Subscription::all();
    }
}
