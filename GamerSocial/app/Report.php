<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\File;

class Report extends Model
{
    protected $fillable = ["title", "game_id", "text", "text", "file_id"];
    
    public function game(){
        return $this->belongsTo(Game::class);
    }
    public function file(){
        return $this->belongsTo(File::class);
    }
}
