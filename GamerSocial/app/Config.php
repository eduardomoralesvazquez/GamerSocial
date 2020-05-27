<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Config extends Model
{
    protected $fillable = ["nick", "theme", "user_id"];
    
    public function user(){
        return $this->belongsTo(User::class);
    } 
}
