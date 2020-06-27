<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //le champ li ghady persiste
    protected $fillable=['title','content','slug','active'];
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
