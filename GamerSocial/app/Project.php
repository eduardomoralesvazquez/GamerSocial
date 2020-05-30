<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\File;
use App\Post;

class Project extends Model
{
    protected $fillable = ["user_id", "title", "summary", "img"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function files(){
        return $this->hasMany(File::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
