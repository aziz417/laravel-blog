<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($id)
    {
        $user = Auth::user();

        if ($user->favorite_posts()->where('post_id', $id)->count() == 0){
            $user->favorite_posts()->attach($id);
            Toastr::success('Post successfully added to your favorite list', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }else{
            $user->favorite_posts()->detach($id);
            Toastr::success('Post successfully removed form you favorite list', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

    }
}
