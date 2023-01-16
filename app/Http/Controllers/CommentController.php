<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Jobs\TestJob;
use App\Models\Comment;
use App\Models\Product;
use App\Jobs\TestJobRoute;
use Illuminate\Http\Request;
use App\Events\CommentPosted;
use App\Mail\BlogCommentPosted;
use App\Mail\ProductCommentPosted;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeProductComment(Request $request,$id)
    {
   $product=Product::findOrfail($id);
    $request->validate([
    'commentaire'=>'required|max:300',
   ]);

   $comment=$product->comments()->create([
    'commentaire'=>$request->commentaire,
    'user_id'=>auth()->id(),
   ]);

  event(new CommentPosted($comment));
  // Mail::to($product->shop->user->email)->send(new ProductCommentPosted($comment));

   $request->session()->flash('status','a comment for product was created !! ');
   return redirect()->back();
    }


    public function storeBlogComment(Request $request,$id)
    {
        
        $blog=Blog::findOrfail($id);
        $request->validate([
       'commentaire'=>'required|max:300',
           ]);
           $comment=$blog->comments()->create([
            'commentaire'=>$request->commentaire,
            'user_id'=>auth()->id(),
           ]);

event(new CommentPosted($comment));
//  Mail::to($blog->user->email)->send(new BlogCommentPosted($comment));
 TestJob::dispatch($comment); // externaliser une classe de type job
        // $when=now()->addMinutes(1);
        // Mail::to($blog->user->email)->later($when,new BlogCommentPosted($comment));


          $request->session()->flash('status','a comment for blog was created !! ');
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
