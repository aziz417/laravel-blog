<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    public function edit(){
        $user = Auth::user();
        return view('backend.author.profile', compact('user'));
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
