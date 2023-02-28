<?php

namespace  App\Repositories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BlogRepository{



    public function search(Request $request)
    {
        $searchTerm  = $request->input('search');
        $blogs = Blog::with(['categories','user'])
        ->where('title', 'LIKE', "%$searchTerm%")
        ->orWhere('description', 'LIKE', "%$searchTerm%")
        ->orWhereHas('categories', function(Builder $query) use ($searchTerm ) {
            $query->where('name', 'LIKE', "%$searchTerm%");
        })
        ->get();
        return $blogs;
    }



    public function store_blog(Request $request)
    {
        $user=auth()->id();// or $request->user()->id
        $validData=$request->validate([
        'title'=>'required|string|min:4',
        'description'=>'required|string',
        'category_id'=>'required',
    ]);
       $validData['user_id']=$user;
      return Blog::create($validData);
    }
    public function store_blog_categories(Blog $blog,Request $request)
    {
 //store categories--
 $filteredAttributeNames = array_filter($request->keys(), function ($key){
    return strpos($key, 'category-') === 0;
});
$filteredAttributeNames = collect($filteredAttributeNames);
$filteredAttributeNames->push('category_id');
$categories=$request->only($filteredAttributeNames->toArray());
$categoriesIds=collect($categories)->values()->toArray();
$blog->categories()->sync($categoriesIds);
$blog->save();
//end store categories
    }


}
