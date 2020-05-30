<?php

namespace App\Http\Controllers;

use App\Post;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        switch($request->origin){
            case 0:
                $request->validate([
                    "text"=>"required"
                ]);
                if(trim($request->text) != ""){
                    trim($request->text);            
                    Post::create(["text"=>$request->text, "user_id"=>Auth::user()->id]);
                }
                return redirect()->route("home");
                break;
            case 1: 

                $request->validate([
                    "text"=>"required",
                    "thread"=>"required"
                ]);
                if(trim($request->text) != ""){
                    trim($request->text);            
                    Post::create(["text"=>$request->text, "user_id"=>Auth::user()->id, "post_id"=>$request->thread]);
                }
                return redirect()->route("thread", Post::find($request->thread));
                break;
            case 2:
                $request->validate([
                    "text"=>"required",
                    "project"=>"required"
                ]);
                if(trim($request->text) != ""){
                    trim($request->text);
                    $post = Post::create(["text"=>$request->text, "user_id"=>Auth::user()->id, "project_id"=>$request->project]);
                }
                return redirect()->route("projectview", Project::find($request->project));
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $request->validate([
            "origin"=>["required"]
        ]);
        if($post->user->id == Auth::user()->id || Auth::user()->role->id == 1 || Auth::user()->role->id == 2){
            $post->delete();
        }
        switch($request->origin){
            case 0:
                return redirect()->route("home");
                break;
            case 1:
                break;
                return redirect()->route("profile", Auth::user());
            case 2:
                return redirect()->route("projectview", $request->project);
                break;
            case 3:
                return redirect()->route("thread", $request->thread);

        }
        // return redirect();
    }
}
