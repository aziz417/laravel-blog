<?php

namespace App\Http\Controllers\Author;
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
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();

        return view('backend.author.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.author.post.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'body'       => 'required',
            'tags'       => 'required',
            'categories' => 'required',
            'img'        => 'required|image',
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
        $request['is_approved'] = false;

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
        if($post->user_id != Auth::id()){

            Toastr::error('Your are not authorized to access this post', 'error');
            return redirect()->route('author.posts.index');
        }
        return view('backend.author.post.view', compact('post'));
    }

    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){

            Toastr::error('Your are not authorized to access this post', 'error');
            return redirect()->route('author.posts.index');
        }
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.author.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'      => 'required',
            'body'       => 'required',
            'tags'       => 'required',
            'categories' => 'required',
            'img'        => 'image',
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
        $request['is_approved'] = false;

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
        if($post->user_id != Auth::id()){
            Toastr::error('Your are not authorized to access this post', 'error');
            return redirect()->route('author.posts.index');
        }

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
