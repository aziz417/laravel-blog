<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboard(){
        $post = new post();
        $user = new user();
        $posts = $post->all();
        // popular post find
        $popular_posts = $post->withCount('comments')
                        ->withCount('favorite_to_users')
                        ->orderBy('view_count', 'desc')
                        ->orderBy('comments_count', 'desc')
                        ->orderBy('favorite_to_users_count', 'desc')
                        ->take('10')->get();

        //find all pending posts
        $pending_posts = $post->NotApproved()->get();

        //all posts view count
        $view_count = $post->sum('view_count');

        // Author count
        $authors = $user->author()->get();

        // new author within 7 days ago registration
        $new_authors = $user->author()->whereDate('created_at', '>', Carbon::now()->subDays(7))->count();

        //Popular Authors
        $popular_authors = $user->author()
                                ->withCount('comments')
                                ->withCount('posts')
                                ->withCount('favorite_posts')
                                ->orderBy('comments_count', 'desc')
                                ->orderBy('posts_count', 'desc')
                                ->orderBy('favorite_posts_count', 'desc')
                                ->take(10)->get();
        // category count
        $categories = Category::all()->count();
        //tag count
        $tags = Tag::all()->count();

        return view('backend.admin.dashboard', compact('posts', 'popular_posts', 'pending_posts', 'view_count', 'authors', 'new_authors', 'popular_authors', 'categories', 'tags'));
    }
    public function edit(){
        $user = Auth::user();
        return view('backend.admin.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $user = Auth::user()->findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if(!empty($request->password)){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
            $request['password'] = Hash::make($request->password);
        }else{
            $request['password'] = $user->password;
        }

        $name = Str::slug($request->name);
        $image = $request->file('img');

        if (isset($image)) {
            //current date
            $currentDate = Carbon::now()->toDateString();
            //generate image name
            $imageName = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            //check post directory exists
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
            //resize image for post
            $profileImage = Image::make($image)->resize(300, 266)->stream();
            Storage::disk('public')->put('profile/' . $imageName, $profileImage);
            // delete old image
            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }
        } else {
            $imageName = $user->image;
        }
        if ($user->role_id == 1 && $user->username == "Admin"){
            $request['role_id'] = 1;
            $request['username'] = "Admin";
        }else{
            $request['role_id'] = 2;
            $request['username'] = "Author";
        }
        $request['image'] = $imageName;
        $user->update($request->all());
        Toastr::success('Profile update successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
