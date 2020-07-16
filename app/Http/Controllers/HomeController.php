<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;

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
        $randomPosts = Post::all()->random(3);
        return view('frontend.page.postDetails', compact('post', 'randomPosts'));
    }
}
