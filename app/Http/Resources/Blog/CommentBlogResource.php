<?php

namespace App\Http\Resources\Blog;

use App\Http\Resources\UserCommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      // // return parent::toArray($request);

        return [

            'comment id'=>$this->id,
            'comment type'=>$this->commentable_type,
            'the commented blog'=>$this->commentable->title,
            'commentaire'=>$this->commentaire,
            'user'=>new UserCommentResource($this->whenLoaded('user')),
           
        ];
    }
    
}
