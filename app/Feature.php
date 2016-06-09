<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    /*Relation between tables */

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }
}
