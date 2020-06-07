<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\Room;
use App\Msg;
use App\Project;
use App\Config;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'real_name','last_name', "img", "banner", "description", "email_verified_at"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo("App\Role");
    }
    public function room(){
        return $this->hasMany(Room::class);
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function msg(){
        return $this->hasMany(Msg::class);
    }
    public function follow(){
        return $this->hasMany(Follow::class, "user_id");
    }
    public function followed(){
        return $this->hasMany(Follow::class, "followed");
    }
    public function config(){
        return $this->hasOne(Config::class);
    }
    public function post(){
        return $this->hasMany(Post::class);
    }
    public function test($user){
        return Follow::where("user_id", $this->id)->where("followed", $user->id)->count();
    }
    public function getFollowers(){
        $followersId = Follow::where("followed", $this->id)->pluck("user_id");
        return User::whereIn("id", $followersId)->get();
    }
    public function getFollowing(){
        $followingId = Follow::where("user_id", $this->id)->pluck("followed");
        return User::whereIn("id", $followingId)->get();
    }
    public function following(User $user){
        if(Follow::where("user_id", $this->id)->where("followed", $user->id)->count()){
            return true;
        }
        return false;
    }
    public function friends(User $user){
        if(
            Follow::where("user_id", $this->id)->where("followed", $user->id)->count() &&
            Follow::where("user_id", $user->id)->where("followed", $this->id)->count()
        )
        {
            return true;
        }
        return false;
    }
    public function postFollow(){
        $follow = $this->follow()->pluck("followed")->toArray();
        $follow[]=$this->id;
        $posts = Post::whereIn("user_id", $follow)->orderByDesc("created_at")->paginate(5);
        return $posts;
    }
    public function scopeName($query, $name){
        return $query->where('name',"like", "%$name%");
    }
    public function scopeRole($query, $role){
        if($role != 0 && $role !=null){
        
            return $query->where('role_id',"=", "$role");
    
        }else{

            return $query;

        }
    }
    public function getFriends(){

        $friendsId = [];
        $followers = $this->getFollowers()->all();
        $following = $this->getFollowing()->all();
        $friends = array_intersect($followers, $following);
        foreach ($friends as $friend) {
            $friendsId[] = $friend["id"];
        }
        $friends = User::whereIn("id", $friendsId)->get();
        return $friends;

    }
}
