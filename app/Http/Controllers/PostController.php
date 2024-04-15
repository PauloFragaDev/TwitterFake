<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index (User $user){


        $posts = $user->posts()->get()->sortDesc();

        return view('dashboard',[
            "user" => $user,
            "posts" => $posts,
        ]);
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function store(Request $req){

        $this->validate($req,[
            'post_content' => 'required',
        ]);


        Post::create([
            'post_content' => $req->get('post_content'),
            'post_image' => $req->get('post_image'),
            'user_id' => $req->get('user_id')
        ]);
        return redirect()->route('posts.index',Auth::user());
    }

    public function show(User $user,Post $post){
        if ($post->user_id === $user->id) {
            return view('posts.show', [
                "post" => $post,
                "listComments" => $post->comments()->get()->sortDesc()
            ]);
        } else {
            abort(404);
        }
    }

    public function destroy(Request $req){
        Post::destroy($req->get('post_id'));
        return redirect()->route('posts.index',Auth::user());
    }

}
