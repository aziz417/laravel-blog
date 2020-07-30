<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Tag;
use App\User;
use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        //dd(config('customConfig.full_name'));
        $categories = Category::latest()->take(10)->get();
        $posts = Post::status()->approved()->orderBy('id', 'DESC')->paginate(10);

        return view('frontend.welcome', compact('categories','posts'));
    }

    public function details($id){

        $post = Post::where('id', $id)->status()->approved()->first();

        $blogKey = 'blog_'.$post->id;

        if(!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey);
        }
        $randomPosts = Post::status()->approved()->take(3)->inRandomOrder()->get();

        return view('frontend.page.postDetails', compact('post', 'randomPosts'));
    }

    public function allPost(){
        $posts = Post::status()->approved()->orderBy('id', 'DESC')->paginate(9);
        return view('frontend.page.allPost', compact('posts'));
    }

    public function categoryPosts($slug, $id){
        $category =Category::where('id', $id)->first();
        $posts = $category->posts()->status()->approved()->paginate(8);
        return view('frontend.page.categoryPosts', compact('posts', 'category'));
    }

    public function tagPosts($slug, $id){
        $tag =Tag::where('id', $id)->first();
        $posts = $tag->posts()->status()->approved()->paginate(8);
        return view('frontend.page.tagPosts', compact('posts', 'tag' ));
    }

    public function search(Request $request){
        $key = $request->search;
        $posts = Post::where('title', 'like', "%$key%")->approved()->status()->paginate(8);
        return view('frontend.page.searchPost', compact('posts', 'key'));
    }

    // this controller return author info and all post of author
    public function authorPosts($slug, $id){
        $author = User::where('id', $id)->first();
        $posts = $author->posts()->approved()->status()->orderBy('id', 'DESC')->paginate(1);

        return view('frontend.page.authorProfile', compact('author', 'posts'));
    }

    public function test(){
        return view('frontend.test');
    }
}
