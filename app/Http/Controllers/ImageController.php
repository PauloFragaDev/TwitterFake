<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $req){
        $imatge = $req->file('file');
        $nameImage = Str::uuid() . "." . $imatge->extension();
        $imageServer = Image::make($imatge);
        $imagePath = public_path('uploads/posts') . "/" . $nameImage;
        $imageServer->save($imagePath);
        return response()->json([
            'nameImage' => $nameImage
        ],200);
    }
    public function storeProfile(Request $req){
        $imatge = $req->file('file');
        $nameImage = Str::uuid() . "." . $imatge->extension();
        $imageServer = Image::make($imatge);
        $imagePath = public_path('uploads/profile') . "/" . $nameImage;
        $imageServer->fit('400',);
        $imageServer->save($imagePath);
        return response()->json([
            'userImage' => $nameImage
        ],200);
    }
    public function storeBanner(Request $req){
        $imatge = $req->file('file');
        $nameImage = Str::uuid() . "." . $imatge->extension();
        $imageServer = Image::make($imatge);
        $imagePath = public_path('uploads/banner') . "/" . $nameImage;
        $imageServer->fit('1000');
        $imageServer->save($imagePath);
        return response()->json([
            'userBanner' => $nameImage
        ],200);
    }

    public function purge(){
        $imagesPost = File::allFiles(public_path('uploads/posts'));
        foreach ($imagesPost as $image){
            $post = Post::all()->where('post_image',$image->getFilename());
            if ($post->isEmpty()){
                File::delete($image);
            }
        }
        $imagesProfile = File::allFiles(public_path('uploads/profile'));
        foreach ($imagesProfile as $image){
            $user = User::all()->where('user_image',$image->getFilename());
            if ($user->isEmpty()){
                File::delete($image);
            }
        }
        $imagesBanner = File::allFiles(public_path('uploads/banner'));
        foreach ($imagesBanner as $image){
            $user = User::all()->where('user_banner',$image->getFilename());
            if ($user->isEmpty()){
                File::delete($image);
            }
        }
        return back();
    }

}
