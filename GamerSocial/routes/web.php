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

Route::get("/crud", "UserController@crud")->name('crud')->middleware("verified");
Route::get('/home', 'HomeController@index')->name('home')->middleware("verified");
Route::get("/dev", "UserController@dev")->name("developer");
Route::get("/profile/{user}", "UserController@profile")->name("profile")->middleware("verified");;
Route::get("/follow/{user}", "FollowController@userStore")->name("followuser.create")->middleware("verified");
Route::get("/config", "UserController@config")->name("user.config")->middleware("verified");
Route::get("/project", "ProjectController@project")->name("project")->middleware("verified");
Route::get("/thread/{post}", "PostController@thread")->name("thread")->middleware("verified");
Route::get("/projectview/{project}", "ProjectController@projectView")->name("projectview")->middleware("verified");
Route::get("/search", "UserController@search")->name("search")->middleware("verified");
Route::get("/follows", "UserController@follow")->name("follows")->middleware("verified");

//GET chat--------------------------------------------------------------------------------------------------------------------------------------

Route::get("/chat", "RoomController@chat")->name("chat")->middleware("verified");
Route::get("/chat/{user}", "RoomController@room")->name("room")->middleware("verified");

//GET Pagination--------------------------------------------------------------------------------------------------------------------------------

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

//POST chat-------------------------------------------------------------------------------------------------------------------------------------

Route::post("/chat/send", "MsgController@send")->name("msg.send")->middleware("verified");
Route::post("/chat/receive", "MsgController@receive")->name("msg.receive")->middleware("verified");

//POST CRUD routes------------------------------------------------------------------------------------------------------------------------------

Route::post("/crud/user", "UserController@store")->name("user.store")->middleware("verified");

//PUT-------------------------------------------------------------------------------------------------------------------------------------------

Route::put("/updateuser", "UserController@userUpdate")->name("useruser.update")->middleware("verified");
Route::put("/user/{user}", "UserController@update")->name("user.update")->middleware("verified");
