<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;


class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs=Blog::all();
        $categories=Category::all();
        $categoriesIds=collect($categories)->pluck('id');
        $blogs->each(function($blog) use($categoriesIds){
            $take=random_int(1,$categoriesIds->count());
            $blog->categories()->sync($categoriesIds->random($take));
        });
    }
}
