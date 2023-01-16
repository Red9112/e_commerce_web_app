<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Product;
use App\Observers\BlogObserver;
use App\Observers\CommentObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\Blog\BlogResource;
use App\Http\ViewComposers\ActivityComposer;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
     view()->composer('blogs.sidebar',ActivityComposer::class);
    //  view()->composer('*',ActivityComposer::class); ==>>>to inject data in all the views
    Comment::observe(CommentObserver::class);
    Blog::observe(BlogObserver::class);
    Product::observe(ProductObserver::class);

    // vd_172-response wrapping:
    //BlogResource::withoutWrapping();
    JsonResource::withoutWrapping();

    
    }
}
