<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Model\Post;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtraController extends Controller
{
    public function index(){
        $posts = Auth::user()->favorite_posts;
        return view('backend.admin.extra.favorite', compact('posts'));
    }

    public function show($id){
        $post = Auth::user()->favorite_posts()->where('post_id', $id)->get();
        $postFavoriteCounts = $post->count();
        $post = $post[0];
        return view('backend.admin.extra.favoritePostView', compact('post', 'postFavoriteCounts'));
    }

    public function destroy($id){
        Auth::user()->favorite_posts()->detach($id);
        Toastr::success('Your this post remove to favorite list is successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.favorites.index');
    }

    public function commentIndex(){
        $comments = Comment::orderBy('id', 'DESC')->get();
        return view('backend.comment.index', compact('comments'));
    }

    public function commentDestroy($id){
        Comment::findOrFail($id)->delete();
        Toastr::success('Comment delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }

    public function AuthorIndex(){
        $authors = Auth::user()->all();
        return view('backend.admin.author.index', compact('authors'));
    }

    public function AuthorDestroy($id){
        $user  = Auth::user()->where('id', $id)->first();
        $posts = Post::where('user_id', $id)->get();
        $storage = Storage::disk('public');

        if ($storage->exists('profile/'.$user->image)){
            $storage->delete('profile/'.$user->image);
        }

        foreach($posts as $post){
            if($storage->exists('post/').$post->image){
                $storage->delete('post/'.$post->image);
            }
        }

        $user->delete();
        Toastr::success('Author delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }
}
