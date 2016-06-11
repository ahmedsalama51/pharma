<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// soft delete
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     use SoftDeletes; //<--- use the softdelete traits
 
    protected $dates = ['deleted_at']; //<--- new field to be added in your table
 
    protected $fillable = [
         'content',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*Relation between tables */
    protected $hidden = [
        'post_id', 'user_id',
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
     public function post()
    {
    	return $this->belongsTo(Post::class);
    }
    public function commentups()
    {
        return $this->hasMany(Commentup::class,'comment_id');
    }
}
