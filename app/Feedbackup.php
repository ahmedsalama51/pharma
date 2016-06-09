<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedbackup extends Model
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
         'user_id','feedback_id',
    ];
    /*Relation between tables */
/*    public function user()
    {
    	return $this->belongsTo(User::class);
    }*/

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

}
