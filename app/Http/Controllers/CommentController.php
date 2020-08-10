<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Post;
use App\Model\Reply;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $request->validate([
            'comment' => 'required',
        ]);

        $request['user_id'] = Auth::id();
        $request['post_id'] = $id;

        Comment::create($request->all());
        Toastr::success('Comment publish successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function replyStore(Request $request, $id){
        $request->validate([
            'reply' => 'required',
        ]);

        $request['user_id'] = Auth::id();
        $request['comment_id'] = $id;

        Reply::create($request->all());
        Toastr::success('Reply publish successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
