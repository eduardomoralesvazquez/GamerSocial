<?php

namespace App\Http\Controllers;

use App\Msg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class MsgController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function show(Msg $msg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function edit(Msg $msg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Msg $msg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Msg $msg)
    {
        //
    }
    //Method for js
    public function send(Request $request){
        $request->validate([
            "to"=>["required"],
            "from"=>["required"],
            "room"=>["required"],
            "text"=>["required"]
        ]);
        if(Auth::user()->id == $request->from && Auth::user()->friends(User::find($request->to))){

            $msg = Msg::create([
                "room_id" => $request->room,
                "user_id"=>$request->from,
                "msg"=>$request->text
            ]);

        }

        return view("chat.msgsend", compact("msg"));
    }
    public function receive(Request $request){
        $request->validate([
            "to"=>["required"],
            "from"=>["required"],
            "room"=>["required"]
        ]);
        if(Auth::user()->id == $request->from && Auth::user()->friends(User::find($request->to))){

            $received = Msg::where("room_id", "=", $request->room)->where("user_id", "=", $request->to)->whereNull("viewed")->get();

            foreach ($received as $msg) {
                $msg->update(["viewed"=>now()]);
            }

        }
        if($received->count() == 0){
            return "";
        }else{
            return view("chat.msgreceive", compact("received"));
        }
    }
}
