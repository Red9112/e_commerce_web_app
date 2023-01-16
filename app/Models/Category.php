<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'parent_id', 
    ]; 
     //Relations:
     public function childrens(){
        return $this->hasMany('App\Models\Category','parent_id');
     }
     public function parent(){
        return $this->belongsTo('App\Models\Category','parent_id');
     }
     
     public function products()
     {
         return $this->morphedByMany('App\Models\Product', 'categoreable');
     }
     public function blogs()
     {
         return $this->morphedByMany('App\Models\Blog', 'categoreable');
     }


}
