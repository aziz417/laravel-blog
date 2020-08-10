<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class Reply extends Model
{
    protected $fillable = ['user_id', 'comment_id', 'reply', 'reply_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comment(){
        return $this->belongsTo(Comment::Class);
    }

}

