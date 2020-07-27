<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static status()
 * @method static where(string $string, $id)
 */
class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'image', 'body', 'view_count', 'status', 'is_approved'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany('App\Model\Comment');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    public function scopeNotApproved($query){
        return $query->where('is_approved', 0);
    }
}
