<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillabe = ["owner", "title", "state", "summary", "file_id"];
}
