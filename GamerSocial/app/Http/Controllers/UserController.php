<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\Follow;
use App\User;
use App\File;
use App\Project;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        if(Auth::user()->role->name == "administrator"){

            $roles = Role::all();
            $users = User::whereNotIn("id", ["1", Auth::user()->id])->name($request->search)->role($request->role)->orderByDesc("id")->paginate("5");
            return view("crud.users.index", compact("users", "request", "roles"));
        
        }else{

            return view("home");

        }
    }
    
    public function create()
    {
        if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){
            
            $roles = Role::orderBy("id")->get();
            return view("crud.users.create", compact("roles"));
            
        }else{

            return view("home");

        }
    }
    
    public function store(Request $request)
    {
        if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){


            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'real_name'=> ['required', 'string'],
                'last_name'=>['required', 'string'],
                "role_id" =>["required"]
            ]);
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'real_name'=> $request->real_name,
                'last_name'=>$request->last_name,
                'role_id'=> $request->role_id,
                "description"=>$request->description,
                'password' => Hash::make($request->password),
                "email_verified_at" => now()
            ]);
            
            return redirect()->route("user.index");

        }else{

            return view("home");

        }
    }
    
    public function edit(User $user)
    {
        if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){

            $roles = Role::orderBy("id")->get();
            return view("crud.users.edit", compact("user", "roles"));
            
        }else{

            return view("home");

        }
    }
    
    public function update(Request $request, User $user){

            if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){

                
            $request->validate([
                "name"=>["required"],
                "description"=>["required"],
                "real_name"=>["required"],
                "last_name"=>["required"],
                "email"=>["required", "unique:users,email,".$user->id],
                "role_id"=>["required"]
            ]);
            if($request->has("img")){
                $request->validate([
                    "img"=>["image"]
                ]);

                $file=$request->file("img");

                $name = "users/".time()."_".$file->getClientOriginalName();

                Storage::disk("public")->put($name, \File::get($file));
                $img=$user->img;
                if(basename($img)!="default.jpg"){

                    unlink($img);

                }

                $user->update(["img" => "img/$name"]);
            }
            if($request->has("banner")){
                $request->validate([
                    "banner"=>["image"]
                ]);

                $file=$request->file("banner");

                $name = "banners/".time()."_".$file->getClientOriginalName();

                Storage::disk("public")->put($name, \File::get($file));
                $img=$user->banner;
                if(basename($img)!="default.png"){

                    unlink($img);

                }

                $user->update(["banner" => "img/$name"]);
            }
            
            if($request->password != null){
                $user->update(["password" => Hash::make($request->password)]);
            }
            $user->update([
                "name"=>$request->name, 
                "description"=>$request->description,
                "real_name"=>$request->real_name,
                "last_name"=>$request->last_name,
                "email"=>$request->email,
                "role_id"=>$request->role_id
            ]);
            return redirect()->route("user.index");
            
        }else{

            return view("home");

        }
    }

    public function destroy(User $user)
    {
        if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){

            $projects = $user->projects()->get();
            
            foreach ($projects as $project) {

                foreach($project->files()->get() as $file){
                    unlink($file->route);
                }
                unlink($project->img);
                $project->delete();

            }
            $img=$user->img;
            if(basename($img)!="default.jpg"){

                unlink($img);

            }
            $img=$user->banner;
            if(basename($img)!="default.png"){

                unlink($img);

            }
            $user->delete();
            return redirect()->route("user.index");
            
        }else{

            return view("home");

        }
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

    public function crud(){
        
        if((Auth::user()->role->name == "administrator") || (Auth::user()->role->name == "moderator")){    
            return view("crud.crud");
        }else{
            return redirect()->route("home");
        }

    }

    public function dev(){
        return view("devcontact");
    }

    public function profile(User $user){
        return view("profile", compact("user"));
    }

    public function config(){
        return view("config");
    }

    public function search(Request $request){

        $users = User::name($request->search)->orderByDesc("created_at")->paginate(5);
        $projects = Project::title($request->search)->orderByDesc("created_at")->paginate(5);

        return view("search", compact("users", "projects")); 

    }

    public function follow(){
        
        $followers = Auth::user()->getFollowers();
        $following = Auth::user()->getFollowing();

        return view("follow", compact("followers", "following")); 
        
    }

}
