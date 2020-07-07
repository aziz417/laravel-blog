<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'image', 'body', 'view_count', 'status', 'is_approved'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category')->withTimestamps();
    }
}
