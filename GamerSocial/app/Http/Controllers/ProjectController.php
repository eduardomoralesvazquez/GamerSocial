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
    public function index()
    {
        //
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

        $file = $request->file("img");
        $name = "projects/".time()."_".$file->getClientOriginalName();
        Storage::disk("public")->put($name, \File::get($file));
        $project = Project::create([
            
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "summary" => $request->summary,
            "img"=> "img/".$name

        ]);
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
        if($project->user()->first()->id == Auth::user()->id){

            foreach($project->files()->get() as $file){
                unlink($file->route);
            }
            unlink($project->img);
            $project->delete();

        }
        if($request->profile == 0){
            return redirect()->route("project");
        }elseif($request->profile == 1){
            return redirect()->route("profile", Auth::user());
        }
    }
}
