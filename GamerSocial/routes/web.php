<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\testMail;
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
Route::get("/dev", function (){
    return view("devcontact");
})->name("developer");
//test---------------------------------------------------------------------------

Route::get("/test", function (){
    return view("confirm");
});