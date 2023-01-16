<?php

namespace App\Imports;

use App\Models\Category;
use FontLib\Table\Type\name;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Category([
            'name'=>$row['name'],
            'parent_id'=>$row['parent_id'],
        ]);
    }
}
