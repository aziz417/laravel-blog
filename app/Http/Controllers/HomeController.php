<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Tag;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        //dd(config('customConfig.full_name'));
        $categories = Category::latest()->take(10)->get();
        $posts = Post::latest()->take(10)->get();

        return view('frontend.welcome', compact('categories','posts'));
    }

    public function details($id){

        $post = Post::where('id', $id)->first();

        $blogKey = 'blog_'.$post->id;

        if(!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey);
        }
        $randomPosts = Post::all()->random(3);
        return view('frontend.page.postDetails', compact('post', 'randomPosts'));
    }
    public function allPost(){
        $posts = Post::latest()->paginate(9);
        return view('frontend.page.allPost', compact('posts'));
    }

    public function categoryPosts($slug, $id){
        $category =Tag::where('id', $id)->first();
        return view('frontend.page.categoryPosts', compact('category'));
    }

    public function tagPosts($slug, $id){
        $tag =Tag::where('id', $id)->first();
        return view('frontend.page.tagPosts', compact('tag'));
    }
}
