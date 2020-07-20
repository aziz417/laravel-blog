<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 * @method static where(string $string, $id)
 */
class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image'];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

}
