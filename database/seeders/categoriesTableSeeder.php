<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
    // $catNbrWithout =(int)$this->command->ask('How much categories without parent do you want to generate ?', 5);
      //  $categories=\App\Models\Category::factory($catNbrWithout)->create();
      $categories=collect(['Travel','Books','News','Courses','Games','Technology','Science','fitness','Sport','Mobil','Cars','Food','Wines','breed','pc','informatique']);
        $categories->each(function($cat){
          $category=new Category;
          $category->name=$cat;
          $category->save();
        });
        $categories=Category::all();
        $catNbrWith = (int)$this->command->ask('How much categories with parent do you want to generate ?',5);
        \App\Models\Category::factory($catNbrWith)->make()->each(function($category) use($categories){
          $category->parent_id=$categories->random()->id;
          $category->save();
      });
    }
}
