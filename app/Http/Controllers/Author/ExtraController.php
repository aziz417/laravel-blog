<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Model\Comment;
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

    public function commentIndex(){
        $user = Auth::id();
        $comments = Comment::where('user_id', $user)->orderBy('id', 'DESC')->get();
        return view('backend.comment.index', compact('comments'));
    }

    public function commentDestroy($id){

        $comment = Comment::findOrFail($id);
        if($comment->user_id == Auth::id()){
            $comment->delete();
            Toastr::success('Comment delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }else{
            Toastr::success('You can not delete this Comment', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
