<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Post;
use App\Model\Replies;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $request->validate([
            'comment' => 'required',
        ]);

        $request['user_id'] = Auth::id();
        $request['parent_id'] = 3;
        $request['mentioned_id'] = 2;
        $request['commentable_id'] = $id;
        $request['commentable_type'] = "Comment";
        $request['body'] = $request->comment;
        //dd($request->all());
        $test = Comment::create($request->all());

        Toastr::success('Comment publish successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function replyStore(Request $request, $id){
        $request->validate([
            'reply' => 'required',
        ]);

        $request['user_id'] = Auth::id();
        $request['comment_id'] = $id;
        $request['reply_id'] = $request->reply_id;

        $t = Replies::create($request->all());
        //dd($t);
        Toastr::success('Reply publish successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
