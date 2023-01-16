<?php

namespace App\Http\Resources\Blog;

use App\Models\User;
use App\Http\Resources\Blog\CommentBlogResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       ////return parent::toArray($request);
       return [
        'blog id'=>$this->id,
        'blog author'=> $this->user->name,
        'title'=> $this->title,
        'description'=>  $this->description,
        'comments'=> CommentBlogResource::collection($this->comments),
       ];
    }
}
