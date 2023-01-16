<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=Product::all();
        $categories=Category::all();
        $categoriesIds=collect($categories)->pluck('id');
        $products->each(function($prod) use($categoriesIds){
            $take=random_int(1,$categoriesIds->count());
            $prod->categories()->sync($categoriesIds->random($take));
        });
        
     
    }
}
