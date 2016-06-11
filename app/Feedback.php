<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //<--- use the softdelete traits
class Feedback extends Model
{
      use SoftDeletes; //<--- use the softdelete traits
 
    protected $dates = ['deleted_at']; //<--- new field to be added in your table
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'user_id','feature_id',
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

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
    public function feedcomments()
    {
        return $this->hasMany('App\Feedcomment');
    }
    public function feedbackups()
    {
        return $this->hasMany('App\Feedbackup');
    }

}
