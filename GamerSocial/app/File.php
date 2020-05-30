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
}
