<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\File;
use App\Post;

class Project extends Model
{
    protected $fillable = ["user_id", "title", "summary", "img", "link"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function files(){
        return $this->hasMany(File::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function scopeTitle($query, $title){
        return $query->where('title',"like", "%$title%");
    }
    public function scopeUser($query, $user){
        if($user != null)
            return $query->where('user_id',"=", $user);
        
        return $query;

    }
}
