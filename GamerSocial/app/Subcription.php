<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\User;

class Subcription extends Model
{
    protected $fillable = ["game_id","user_id"];
    public function game(){
        return $this->belongsTo(Game::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
