<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'image',
        'body',
        'user_id',
        'category_id'
    ];


    public function user(){
        return $this->hasOne("App\User", "id", "user_id");
    }

    public function category(){
        return $this->hasOne("App\Category", "id", "category_id");
    }

    public function tags(){
        return $this->hasMany("App\Tag");
    }
}
