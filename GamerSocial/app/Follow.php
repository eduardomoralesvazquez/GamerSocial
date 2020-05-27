<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model
{
    protected $fillable = ["user_id", "followed"];
    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    public function followed(){
        return $this->belongsTo(User::class, "followed");
    }
}
