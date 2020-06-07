<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Msg;

class Room extends Model
{
    protected $fillable = ["user_id", "user2_id"];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function msgs(){
        return $this->hasMany(Msg::class);
    }
    public function user2(){
        return $this->belongsTo(User::class, "user2_id");
    }
    public static function roomExists(User $user){
        if(

            Room::where("user_id", $user->id)->where("user2_id", Auth::user()->id)->count() ||
            Room::where("user_id", Auth::user()->id)->where("user2_id", $user->id)->count() 

        ){

            return true;

        }else {
            
            return false;

        }
    }
}
