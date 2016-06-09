<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// soft delete
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     use SoftDeletes; //<--- use the softdelete traits
 
    protected $dates = ['deleted_at']; //<--- new field to be added in your table
    protected $fillable = [
        'image', 'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_token', 'user_id','views_num',
    ];
    /*Relation between tables */
    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }
    public function postups()
    {
        return $this->hasMany(Postup::class,'post_id');
    }
}
