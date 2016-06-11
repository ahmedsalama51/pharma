<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Request ;
use App\Account ;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Illuminate\Auth\Authenticatable;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Foundation\Auth\Access\Authorizable;
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// class User extends  Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract  {
//     use Authenticatable, Authorizable, CanResetPassword; 
    
//     protected $connection = 'mongodb';
//     protected $collection = 'users';
//     protected $fillable = ['name','email', 'password'];
//     protected $hidden = ['password', 'remember_token'];



// }




class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function isAdmin()
    {
         return $this->admin;
    } 


    public function account()
    {
        return $this->belongsTo(Account::class,'request_id');
    }
    
    public function personal()
    {
        return $this->hasOne('App\Personal_data','user_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post','user_id');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }
    public function feedbackup()
    {
        return $this->hasOne('App\Feedbackup','user_id');
    }
    public function followers()
    {
        return $this->hasMany('App\Follower','follower_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }
    public function postups()
    {
        return $this->hasMany(Postup::class,'user_id');
    }
    public function commentups()
    {
        return $this->hasMany(Commentup::class,'user_id');
    }



}

