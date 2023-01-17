<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\String\Inflector\FrenchInflector;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
public const LANGUAGE=[
    'en'=>'English',
    'fr'=>'French',
    'ar'=>'Arabic'
];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relations:
    public function adresses(){
        return $this->hasMany('App\Models\Adress');
    } 
    public function shop(){ 
        return $this->hasOne('App\Models\Shop');
    }
    public function blogs(){
        return $this->hasMany('App\Models\Blog');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }
    public function defaultImage(){
  return asset('http://localhost:8000/storage/users/defaultUser.jpg');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // local scopes
    public function scopeMostBlogsCreators(Builder $query){
return $query->withCount('blogs')->orderBy('blogs_count','desc');
    }
    public function scopeMostActiveUsersThisMonth(Builder $query){
return $query->withCount(['blogs'=> function(Builder $query){
    return $query->whereBetween(static::CREATED_AT,[now()->subMonth(1),now()]);
}])
->having('blogs_count','>=',1)
->orderBy('blogs_count','desc');
    }










}
