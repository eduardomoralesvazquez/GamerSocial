<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected $fillable = ["owner", "msg", "room"];
}
