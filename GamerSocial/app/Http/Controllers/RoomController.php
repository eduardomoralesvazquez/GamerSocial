<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use App\Msg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
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
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
    //Method for users
    public function chat(){
        $friends = Auth::user()->getFriends();

        return view("chat.chats", compact("friends"));
    }
    public function room(User $user){
        if(Auth::user()->friends($user)){

            if(Room::roomExists($user)){

                $room = Room::where("user_id", $user->id)->where("user2_id", Auth::user()->id)->first();
    
                if($room == null){
    
                    $room = Room::where("user_id", Auth::user()->id)->where("user2_id", $user->id)->first();
    
                }

                $received = Msg::where("room_id", "=", $room->id)->where("user_id", "=", $user->id)->whereNull("viewed")->get();
    
                foreach ($received as $msg) {
                    $msg->update(["viewed"=>now()]);
                }

            }else{

                $room = Room::create(["user_id"=> Auth::user()->id, "user2_id"=>$user->id]);

            }
            $userSend = Auth::user();
            return view("chat.room", compact("room", "user", "userSend"));
        
        }
    }
}
