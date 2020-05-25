<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["owner", "thread", "text", "game_id", "files_id"];
}
