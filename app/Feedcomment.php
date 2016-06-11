<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedcomment extends Model
{
    use SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'user_id','feedback_id',
    ];
    /*Relation between tables */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function commentup()
    {
        return $this->hasOne('App\Feedcommentup');
    }

}