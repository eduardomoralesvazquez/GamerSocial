<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Project;

class Post extends Model
{
    protected $fillable = ["user_id", "post_id", "text", "project_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class, "post_id");
    }
    public function subPosts(){
        return $this->hasMany(Post::class, "post_id");
    }
    public function project(){
        return $this->belongsTo(Post::class, "project_id");
    }
    public function scopeText($query, $text){
        return $query->where('text',"like", "%$text%");
    }
    public function scopeUser($query, $user){
        if($user != null)

            return $query->where('user_id',"=", $user);
        
        return $query;

    }
}
