<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'age', 'sex',
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
    
    public function post()
    {
        return $this->hasMany('App\Post', 'user_id');
    }
    
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_user', 'post_id', 'user_id');
    }
    
    public function followed()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'followed_user_id', 'following_user_id');
    }
    
    public function following()
    {
        return $this->belongsToMany('App\User', 'follow_users', 'following_user_id', 'followed_user_id');
    }
    
    public function comment()
    {
        return $this->hasMany('App\Comment', 'user_id');
    }
    
    public function getByUser(int $limit_count = 5)
    {
         return $this->post()->with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
