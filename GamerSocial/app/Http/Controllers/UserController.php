<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;

class UserController extends Controller
{
    public function update(Request $request){

    }
    //Method to users--------------------------------------------------------
    public function userUpdate(Request $request){
        $request->validate([
            "name"=>["required"],
            "description"=>["required"]
        ]);
        if($request->has("img")){
            $request->validate([
                "img"=>["image"]
            ]);

            $file=$request->file("img");

            $name = "users/".time()."_".$file->getClientOriginalName();

            Storage::disk("public")->put($name, \File::get($file));
            $img=Auth::user()->img;
            if(basename($img)!="default.jpg"){

                unlink($img);

            }

            Auth::user()->update(["img" => "img/$name"]);
        }
        if($request->has("banner")){
            $request->validate([
                "banner"=>["image"]
            ]);

            $file=$request->file("banner");

            $name = "banners/".time()."_".$file->getClientOriginalName();

            Storage::disk("public")->put($name, \File::get($file));
            $img=Auth::user()->banner;
            if(basename($img)!="default.png"){

                unlink($img);

            }

            Auth::user()->update(["banner" => "img/$name"]);
        }
        Auth::user()->update(["name"=>$request->name, "description"=>$request->description]);
        return redirect()->route("profile", Auth::user());

    }
}
