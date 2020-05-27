<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\File;
use App\User;

class Post extends Model
{
    protected $fillable = ["user_id", "post_id", "text", "game_id", "file_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function game(){
        return $this->belongsTo(Game::class);
    }
    public function file(){
        return $this->belongsTo(File::class);
    }

}
