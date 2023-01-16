<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops=Shop::all();
        $categories=collect(Category::all());
        if ( $shops->count()==0 ||$categories->count()==0) {
$shops->count()==0? $this->command->error("please create some shops !"):$this->command->error("please create some categories !");
        return;
        }
        $productsNbr =(int)$this->command->ask('How much products do you want to generate ?',10);
        \App\Models\Product::factory($productsNbr)->create()->each(function ($p) use($categories) {
            $p->categories()->save($categories->random());
    });






} 

}
