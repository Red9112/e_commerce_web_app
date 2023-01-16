<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class commentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs=Blog::all();
        $users=User::all();
        $comNbr =(int)$this->command->ask('How much comments do you want to generate ?',10);
        $comments=\App\Models\Comment::factory($comNbr)->make()->each(function($comment) use($blogs,$users){
            $comment->blog_id=$blogs->random()->id;
            $comment->user_id=$users->random()->id;
            $comment->save();
        });
   
    }


}
