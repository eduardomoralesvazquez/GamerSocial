<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Room extends Model
{
    protected $fillable = ["user_id", "user2_id"];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function user2(){
        return $this->belongsTo(User::class, "user2_id");
    }
}
