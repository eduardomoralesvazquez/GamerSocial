<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\File;

class Project extends Model
{
    protected $fillabe = ["user_id", "title", "state", "summary", "file_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function file(){
        return $this->belongsto(File::class);
    }
}
