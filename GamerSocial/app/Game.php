<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subcription;
use App\Post;
use App\Report;

class Game extends Model
{
    protected $fillable = ["title", "owner", "summary", "platform"];
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function reports(){
        return $this->hasMnay(Report::class);
    }
}
