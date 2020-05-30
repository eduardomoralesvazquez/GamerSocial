<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\testMail;
use App\User;
use App\Project;
use App\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Auth::routes(["verify" => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware("verified");
Route::get("/dev", function (){ return view("devcontact"); })->name("developer");
Route::get("/profile/{user}", function(User $user){ return view("profile", compact("user")); })->name("profile")->middleware("verified");;
Route::get("/follow/{user}", "FollowController@store")->name("follow.create")->middleware("verified");
Route::get("/config", function(){return view("config");})->name("user.config")->middleware("verified");
Route::get("/project", function(){ $projects = Project::all(); return view("project", compact("projects")); })->name("project")->middleware("verified");
Route::get("/thread/{post}", function($post){ $post = Post::find($post); return view("thread", compact("post")); })->name("thread")->middleware("verified");
Route::get("/projectview/{project}", function($project){ $project=Project::find($project); return view("projectview", compact("project")); })->name("projectview")->middleware("verified");

Route::delete("/delete/{post}", "PostController@destroy")->name("post.destroy")->middleware("verified");
Route::delete("/unfollow/{follow}", "FollowController@destroy")->name("follow.destroy")->middleware("verified");
Route::delete("/deletep/{project}", "ProjectController@destroy")->name("project.destroy")->middleware("verified");

Route::post("/createpost", "PostController@store")->name("post.create")->middleware("verified");
Route::post("/createproject", "ProjectController@store")->name("project.create")->middleware("verified");

Route::put("/updateuser", "UserController@update")->name("user.update")->middleware("verified");

//test---------------------------------------------------------------------------

// Route::get("/test", function (){

//     return view("project");

// })->middleware("verified");