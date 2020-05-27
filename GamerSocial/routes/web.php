<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\testMail;
use App\User;
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

Route::delete("/delete/{post}", "PostController@destroy")->name("post.destroy")->middleware("verified");
Route::delete("/unfollow/{follow}", "FollowController@destroy")->name("follow.destroy")->middleware("verified");

Route::post("/createpost", "PostController@store")->name("post.create")->middleware("verified");

//test---------------------------------------------------------------------------

Route::get("/test/{user}", function (User $user){

    return view("profile",compact("user"));

})->middleware("verified");