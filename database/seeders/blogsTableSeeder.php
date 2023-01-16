<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class blogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=\App\Models\User::all();
        if($users->count()==0){
            $this->command->info("please create some users");
            return;
        }
        $nbBlogs=(int)$this->command->ask("How many  Blogs you want generate ?",10);
     \App\Models\Blog::factory( $nbBlogs)->make()->each(function($blog) use($users){
            $blog->user_id=$users->random()->id;
            $blog->save();
        });
    }
}
