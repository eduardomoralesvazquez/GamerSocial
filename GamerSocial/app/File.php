<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;
use App\Post;
use App\Project;

class File extends Model
{
    protected $fillable = ["routes"];
    
    public function report(){
        return $this->hasMany(Report::class);
    }
    public function post(){
        return $this->hasMany(Post::class);
    }
    public function project(){
        return $this->hasMany(Project::class);
    }
}
