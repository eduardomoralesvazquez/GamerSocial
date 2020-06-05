<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class File extends Model
{
    protected $fillable = ["route", "project_id"];

    public function projects(){
        return $this->belongsTo(Project::class);
    }
    public function scopeProject($query, $project){
        if($project != null)

            return $query->where('project_id',"=", $project);
        
        return $query;
    }
}
