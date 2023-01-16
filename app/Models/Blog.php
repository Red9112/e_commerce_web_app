<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
   
    protected $fillable=['title','description','user_id'];
    

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){

        return $this->morphMany('App\Models\Comment','commentable');
        
    }
    public function categories()
{
    return $this->morphToMany('App\Models\Category','categoreable')->withTimestamps();
}

public function scopeMostCommentedBlogs(Builder $query){
return $query->withCount('comments')->orderBy('comments_count','desc');
}
    
public static function boot(){
parent::boot();
static::addGlobalScope(new LatestScope);
    }



}
