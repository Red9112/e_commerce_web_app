<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\BlogRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\CommentBlogResource;


class BlogController extends Controller
{
 private $blogRepositoty;
    public function __construct(BlogRepository $blogRepositoty)
     {
    //    $this->middleware('auth');
    $this->blogRepositoty=$blogRepositoty;
     }
    public function index()
    {
        $blogs=Blog::with('user')->withCount('comments')->get();
        return view('blogs.index',[
            'blogs'=>$blogs,
        ]);
    }

   
    public function create()
    {
        $blog=new Blog();
       $this->authorize('create',$blog);
        $categories=Category::all();
        return view('blogs.create',[
            'categories'=>$categories
        ]);
    }

   
    public function store(Request $request)
    {
        $blog=new Blog();
        $this->authorize('create',$blog);
      $blog=$this->blogRepositoty->store_blog($request);
       $this->blogRepositoty->store_blog_categories($blog,$request);
       $request->session()->flash('status','you created a blog !! ');
return redirect()->route('blog.index');
    }

   
    public function show($id)
    {
        $blog=Cache::remember("blog-{$id}",60, function() use($id)  { // 60=>60 seconds
           return Blog::with(['comments','comments.user'])->findOrfail($id);
        });
       return view('blogs.show',[
        'blog'=>$blog,
       ]);
    }

  
    public function edit(Blog $blog)
    {
      $this->authorize('update',$blog);
      $categories=Category::all();
        return view('blogs.edit',[
            'blog'=>$blog,
            'categories'=>$categories
        ]);
    }

   
    public function update(Request $request,Blog $blog)
    {
        $this->authorize('update',$blog);
        $data=$request->only(['title','description']);
        $blog->update($data);
        $this->blogRepositoty->store_blog_categories($blog,$request);
        $request->session()->flash('status','Blog updated !!');
        return redirect()->route('blog.index');
    }

    
    public function destroy(Request $request,Blog $blog)
    {
        $this->authorize('delete',$blog);
        Blog::destroy($blog->id);
        $request->session()->flash('failed',' Blog Deleted !!');
        return redirect()->route('blog.index');
    }
}
