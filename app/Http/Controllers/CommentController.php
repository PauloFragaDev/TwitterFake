<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $req){

        $this->validate($req, [
            'post_id' => "required",
            'user_id' => "required",
            'comment' => "required",
        ]);

        Comment::create([
            'post_id' => $req->get('post_id'),
            'user_id' => Auth::user()->id,
            'comment' => $req->get('comment')
        ]);

        return redirect()->route('posts.show',[
           'user' => User::find($req->get('user_id')),
           'post' => Post::find($req->get('post_id')),
        ]);

    }
}
