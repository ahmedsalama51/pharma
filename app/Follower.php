<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'follower_id',
    ];
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    public function follower()
    {
        return $this->hasOne('App\User','id','follower_id');
    }

}
