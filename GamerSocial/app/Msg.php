<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Room;

class Msg extends Model
{
    protected $fillable = ["user_id", "msg", "room_id"];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
