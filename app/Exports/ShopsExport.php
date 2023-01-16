<?php

namespace App\Exports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShopsExport implements FromArray,
WithHeadings
    {
  
    public function array(): array
    {
         // return Shop::all()->toArray();
         return Shop::all([
            'id','name','phone_number'
        ])->toArray(); 
    }
   
    public function headings(): array
    {
        return [
            'id',
            'name of shop',
            'Télephone'
        ];
    }
}
