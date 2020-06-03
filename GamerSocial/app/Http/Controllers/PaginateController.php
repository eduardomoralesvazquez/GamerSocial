<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;

class PaginateController extends Controller
{
    //Method to lazy loading
    public function homeResponse(){
        $posts = Auth::user()->postFollow();
        return view("pagination.homePost", compact("posts"));
    }
    public function projectResponse(){
        
        $projects = Project::orderByDesc("created_at")->paginate(5); 
        return view("pagination.projectProjects", compact("projects"));

    }
    public function searchProjectResponse(Request $request){
        
        $projects = Project::title($request->search)->orderByDesc("created_at")->paginate(5);
        return view("pagination.searchProjects", compact("projects"));

    }
    public function searchUserResponse(Request $request){
        
        $users = User::name($request->search)->orderByDesc("created_at")->paginate(5);
        return view("pagination.searchUsers", compact("users"));

    }
}
