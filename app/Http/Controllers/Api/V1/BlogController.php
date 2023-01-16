<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\BlogResource;


class BlogController extends Controller
{

public function __construct(){
$this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page=$request->per_page ?? 5;
        $order_by=$request->order_by ?? 'id';
        $blogs=Blog::with('user')->withCount('comments')->orderBy($order_by,'asc')->paginate($per_page)->appends(['per_page'=>$per_page,'order_by'=>$order_by]);
        return  BlogResource::collection($blogs);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=auth()->id();
        $validData=$request->validate([ 
        'title'=>'required|string|min:4',
        'description'=>'required|string',
        'category_id'=>'required', 
    ]);
    $validData['user_id']=$user;
    $blog=Blog::create($validData);
    $blog->categories()->sync($request->category_id);
     $blog->save();
    return (new BlogResource($blog));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog=Blog::with(['comments','comments.user'])->findOrfail($id);
       return (new BlogResource($blog));
    //  return  (new CommentBlogResource($blog->comments->first()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Blog $blog)
    {
        $data=$request->only(['title','description']);
        $blog->update($data);
     if ($request->category_id) {
        $blog->categories()->sync($request->category_id);
        $blog->save();
     }  
        return (new BlogResource($blog));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
         Blog::destroy($blog->id);
         return response()->noContent();
    }
}
