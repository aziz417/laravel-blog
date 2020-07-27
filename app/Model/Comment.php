<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'comment'];

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
