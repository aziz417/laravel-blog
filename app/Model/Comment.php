<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'body', 'mentioned_id', 'commentable_id', 'commentable_type', 'created_at'];

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function replies(){
        return $this->hasMany('App\Model\Replies', 'comment_id', 'id');
    }
}
