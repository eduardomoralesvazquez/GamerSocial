<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){

            $projects = Project::orderByDesc("id")->title($request->title)->user($request->id)->paginate("5");
            return view("crud.projects.index", compact("projects", "request"));

        }else{

            return view("home");

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Request $request)
    {
        if(Auth::user()->role->name == "administrator" || Auth::user()->role->name == "moderator"){

            foreach($project->files()->get() as $file){
                unlink($file->route);
            }
            unlink($project->img);
            $project->delete();
            
            return redirect()->route("project.index");
            
        }else{

            return view("home");

        }
    }

    //Method for users-----------------------------------------------------------

    public function userStore(Request $request)
    {
        $request->validate([
            "img" => ["required", "image"],
            "title" => ["required"],
            "summary" => ["required"]
        ]);
        
        if($request->has("files")){
            $request->validate([
                "files.*"=>["image"]
            ]);
        }
        if($request->link!=null){
            $request->validate([
                "link"=>["url"]
            ]);
        }

        $file = $request->file("img");
        $name = "projects/".time()."_".$file->getClientOriginalName();
        Storage::disk("public")->put($name, \File::get($file));
        $project = Project::create([
            
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "summary" => $request->summary,
            "img"=> "img/".$name

        ]);
        if($request->link!=null){
            $project->update(["link" => $request->link]);
        }
        if($request->has("files")){
            foreach($request->file("files") as $picture){
                $name = "projects/galleries/".time()."_".$picture->getClientOriginalName();
    
                Storage::disk("public")->put($name, \File::get($picture));
                File::create([
                    "project_id" => $project->id,
                    "route"=> "img/".$name 
                ]);
            }
        }
        return redirect()->route("project");

    }
    public function userDestroy(Project $project, Request $request)
    {
        if($project->user()->first()->id == Auth::user()->id){

            foreach($project->files()->get() as $file){
                unlink($file->route);
            }
            unlink($project->img);
            $project->delete();

        }
        switch($request->origin){
            case 0:
                return redirect()->route("project");
                break;
            case 1:
                return redirect()->route("profile", Auth::user());
                break;
            case 2:
                return redirect()->route("search");
                break;
        }
    }
    public function project(){
        
        $projects = Project::orderByDesc("created_at")->paginate(5); 
        return view("project", compact("projects"));
        
    }

    public function projectView(Project $project){
        return view("projectview", compact("project"));
    }

}
