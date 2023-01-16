<?php

namespace App\Http\ViewComposers;


use App\Models\Blog;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer{



    public function compose(View $view){

 //Cache:
  $mostBlogsCreators=Cache::remember('mostBlogsCreators',now()->addMinutes(10), function () {
 return User::mostBlogsCreators()->take(5)->get();
       });
   $mostActiveUsersThisMonth=Cache::remember('mostActiveUsersThisMonth', now()->addMinutes(10), function () {
   return User::mostActiveUsersThisMonth()->take(5)->get();
       });
       $mostCommentedBlogs=Cache::remember('mostCommentedBlogs',now()->addMinutes(10), function () {
        return Blog::mostCommentedBlogs()->take(5)->get();
              });
 // end cache

 $view->with([
    'mostBlogsCreators'=>$mostBlogsCreators,
    'mostActiveUsersThisMonth'=>$mostActiveUsersThisMonth,
    'mostCommentedBlogs'=>$mostCommentedBlogs,
 ]);




    }

}