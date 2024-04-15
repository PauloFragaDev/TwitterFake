<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function switchLike(Post $post){
        if ($post->checkLike(Auth::user())){
            $post->likes()->where('user_id',Auth::user()->id)->delete();
        } else {
            $post->likes()->create([
                'user_id' => Auth::user()->id,
            ]);
        }
        return back();
    }
}
