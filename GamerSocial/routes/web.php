<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\testMail;
use Illuminate\Http\Request;
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

//GET routes-----------------------------------------------------------------------------------------------------------------------------

Route::get("/crud", function () {
    if((Auth::user()->role->name == "administrator") || (Auth::user()->role->name == "moderator")){    
        return view("crud.crud");
    }else{
        return redirect()->route("home");
    }
})->name('crud')->middleware("verified");
Route::get('/home', 'HomeController@index')->name('home')->middleware("verified");
Route::get("/dev", function (){ return view("devcontact"); })->name("developer");
Route::get("/profile/{user}", function(User $user){ return view("profile", compact("user")); })->name("profile")->middleware("verified");;
Route::get("/follow/{user}", "FollowController@userStore")->name("followuser.create")->middleware("verified");
Route::get("/config", function(){return view("config");})->name("user.config")->middleware("verified");
Route::get("/project", function(){

    $projects = Project::orderByDesc("created_at")->paginate(5); 
    return view("project", compact("projects")); 

})->name("project")->middleware("verified");
Route::get("/thread/{post}", function($post){ $post = Post::find($post); return view("thread", compact("post")); })->name("thread")->middleware("verified");
Route::get("/projectview/{project}", function($project){ $project=Project::find($project); return view("projectview", compact("project")); })->name("projectview")->middleware("verified");
Route::get("/search", function(Request $request){

    $users = User::name($request->search)->orderByDesc("created_at")->paginate(5);
    $projects = Project::title($request->search)->orderByDesc("created_at")->paginate(5);

    return view("search", compact("users", "projects")); 

})->name("search")->middleware("verified");
Route::get("/follows", function(){

    $followers = Auth::user()->getFollowers();
    $following = Auth::user()->getFollowing();

    return view("follow", compact("followers", "following")); 

})->name("follows")->middleware("verified");

//Pagination routes-----------------------------------------------------------------------------------------------------------------------------

Route::get("/home/paginate", "PaginateController@homeResponse")->name("home.pagination")->middleware("verified");
Route::get("/project/paginate", "PaginateController@projectResponse")->name("project.pagination")->middleware("verified");
Route::get("/search/paginate/user", "PaginateController@searchUserResponse")->name("searchUser.pagination")->middleware("verified");
Route::get("/search/paginate/project", "PaginateController@searchProjectResponse")->name("searchProject.pagination")->middleware("verified");

//GET CRUD routes-------------------------------------------------------------------------------------------------------------------------------

    //index
Route::get("/crud/file", "FileController@index")->name("file.index")->middleware("verified");
Route::get("/crud/user", "UserController@index")->name("user.index")->middleware("verified");
Route::get("/crud/project", "ProjectController@index")->name("project.index")->middleware("verified");
Route::get("/crud/post", "PostController@index")->name("post.index")->middleware("verified");
    //create
Route::get("/crud/user/create", "UserController@create")->name("user.create")->middleware("verified");
    //edit
Route::get("/crud/user/{user}/edit", "UserController@edit")->name("user.edit")->middleware("verified");

//DELETE routes---------------------------------------------------------------------------------------------------------------------------------

Route::delete("/delete/{post}", "PostController@userDestroy")->name("postuser.destroy")->middleware("verified");
Route::delete("/unfollow/{follow}", "FollowController@userDestroy")->name("followuser.destroy")->middleware("verified");
Route::delete("/deletep/{project}", "ProjectController@userDestroy")->name("projectuser.destroy")->middleware("verified");

//DELETE CRUD routes----------------------------------------------------------------------------------------------------------------------------

Route::delete("/crud/user/{user}", "UserController@destroy")->name("user.destroy")->middleware("verified");
Route::delete("/crud/project/{project}", "ProjectController@destroy")->name("project.destroy")->middleware("verified");
Route::delete("/crud/post/{post}", "PostController@destroy")->name("post.destroy")->middleware("verified");
Route::delete("/crud/file/{file}", "FileController@destroy")->name("file.destroy")->middleware("verified");

//POST routes-----------------------------------------------------------------------------------------------------------------------------------

Route::post("/createpost", "PostController@userStore")->name("postuser.create")->middleware("verified");
Route::post("/createproject", "ProjectController@userStore")->name("projectuser.create")->middleware("verified");

//POST CRUD routes------------------------------------------------------------------------------------------------------------------------------

Route::post("/crud/user", "UserController@store")->name("user.store")->middleware("verified");

//PUT-------------------------------------------------------------------------------------------------------------------------------------------

Route::put("/updateuser", "UserController@userUpdate")->name("useruser.update")->middleware("verified");
Route::put("/user/{user}", "UserController@update")->name("user.update")->middleware("verified");
