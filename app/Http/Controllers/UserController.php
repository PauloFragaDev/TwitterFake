<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function home()
    {
        if(Auth::check()){
            $users = Auth::user()->followeds()->pluck('followed_id')->toArray();
            $usuarios = User::find($users);

            $postsUsers = [];
            $posts = [];

            foreach ($usuarios as $user){
                $postsUsersGet = Post::all()->where('user_id',$user->id)->sortByDesc('created_at');
                $postsUsers[] = $postsUsersGet;
            }

            foreach ($postsUsers as $postsUser){
                foreach ($postsUser as $post){
                    $posts[] = $post;
                }
            }
            return view('home',[
                'posts' => $posts
            ]);
        }else{
            return view('home',[
                'posts' => Post::all()->sortDesc()
            ]);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function profile(Request $req)
    {
        $user = User::find($req->get('id'));
        if(Auth::user()->is_admin){
            return view('profile')->with([
                "usuarios" => User::all(),
                "selected" => $user
            ]);
        } else{
        return view('profile')->with([
            "selected" => $user
        ]);
        }
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => "required",
            'username' => "required | unique:users",
            'email' => "required | email | unique:users",
            'password' => "required | min:4 | confirmed",
        ]);
        User::create([
            'name' => $req->get('name'),
            'username' => $req->get('username'),
            'email' => $req->get('email'),
            'password' => Hash::make($req->get('password')),
        ]);

        return view('login');

    }

    public function destroy(Request $req)
    {
        User::destroy($req->get('user_id'));
        return redirect()->route('profile',['id' => Auth::user()->id]);
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'username' => 'required | unique:users,username,' . $req->get('id') .'id',
            'email' => 'required | email | unique:users,email,' . $req->get('id') .'id',
            'password' => 'confirmed'
        ]);
        $user = User::find($req->get('id'));
        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        if($req->get('password')){
            $user->password = Hash::make($req->get('password'));
        }
        if($req->get('user_image')){
            $user->user_image = $req->get('user_image');
        }
        if($req->get('user_banner')){
            $user->user_banner = $req->get('user_banner');
        }
        $user->save();

        return redirect()->route('posts.index',['user' => Auth::user()]);

    }

    public function updateBio(Request $req){
        $this->validate($req,[
           'biografia' => 'required'
        ]);
        $user = User::find($req->get('id'));
        $user->bio = $req->get('biografia');
        $user->save();
        return redirect()->route('posts.index',['user' => $user])->with("success","Bio changed successfully");
    }

    public function find(Request $req){
        $user = User::where('username','=',$req->username)->first();
        return redirect()->route('posts.index',$user);
    }

}
