<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['commentaire','blog_id','user_id'];


    public function commentable(){
        return $this->morphTo();
     }
 

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
  

}
