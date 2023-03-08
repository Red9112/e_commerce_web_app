<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url', 
    ];

     //Relations:
     public function imageable(){
        return $this->morphTo();
     }

     public function url(){
       return Storage::url($this->url);
     }

  






}
