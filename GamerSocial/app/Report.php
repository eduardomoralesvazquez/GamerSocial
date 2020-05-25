<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ["title", "game_id", "text", "text", "files_id"];
}
