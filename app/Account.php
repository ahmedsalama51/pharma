<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
	protected $fillable = [
        'name', 'email', 'id_number', 'certificate', 'type',
    ];

	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User','request_id');
    }

}
