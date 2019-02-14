<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected  $guarded = [];
    //用户拥有的文章数
    public function posts(){
        return $this->hasMany(\App\Post::class);
    }
}
