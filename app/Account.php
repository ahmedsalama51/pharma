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
}
