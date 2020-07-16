<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ExtraController extends Controller
{
    public function index(){
        $posts = Auth::user()->favorite_posts;
        return view('backend.author.extra.favorite', compact('posts'));
    }

    public function show($id){
        $post = Auth::user()->favorite_posts()->where('post_id', $id)->get();
        $postFavoriteCounts = $post->count();
        $post = $post[0];
        return view('backend.author.extra.favoritePostView', compact('post', 'postFavoriteCounts'));
    }

    public function destroy($id){
        Auth::user()->favorite_posts()->detach($id);
        Toastr::success('Your this post remove to favorite list is successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('author.favorites.index');

    }
}
