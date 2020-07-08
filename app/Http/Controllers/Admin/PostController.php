<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Category;
use App\Model\Tag;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$posts = Post::with('categories')->latest()->get();
        dd($posts);*/
        $posts = Post::latest()->get();

        return view('backend.admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'     => 'required',
            'body'      => 'required',
            'tags'       => 'required',
            'categories'  => 'required',
            'img'       => 'required|image',
        ]);


        $slug = Str::slug($request->title);
        $image = $request->file('img');


        if(isset($image)){
            //current date
            $currentDate = Carbon::now()->toDateString();
            //ganerate image name
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check post directory exists
            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }

            //resize image for post
            $post = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$post);

        }else{
            $imageName = 'default.png';
        }

        $request['user_id'] = Auth::id();
        $request['slug']    = $slug;
        $request['image']   = $imageName;
        $request['is_approved'] = true;

       if(isset($request->status)){
           $request['status'] = true;
       }else{
           $request['status'] = false;
       }

        $post = Post::create($request->all());

       if($post){
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        Toastr::success('Post create successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
       }
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
