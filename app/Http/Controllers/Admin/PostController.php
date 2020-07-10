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
        return view('backend.admin.post.view', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function pending(){
        $posts = Post::where('is_approved', false)->latest()->get();
        return view('backend.admin.post.pending', compact('posts'));
    }

    public function approve($id){
        $post = Post::find($id);
        $post['is_approved'] = true;

        $post->save();
        return redirect()->back();
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'     => 'required',
            'body'      => 'required',
            'tags'       => 'required',
            'categories'  => 'required',
            'img'       => 'image',
        ]);

        $slug = Str::slug($request->title);
        $image = $request->file('img');

        if(isset($image)){
            //current date
            $currentDate = Carbon::now()->toDateString();
            //generate image name
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check post directory exists
            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            //resize image for post
            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
            // delete old image
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
        }else{
            $imageName = $post->image;
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

        if( $post->update($request->all())){
            $post->categories()->sync($request->categories);
            $post->tags()->sync($request->tags);
            Toastr::success('Post update successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }
    }

    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        Toastr::success('Post delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
