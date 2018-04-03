<?php

namespace App;

use App\Role;
use App\Constants;
use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{

    protected $fillable = [
    	'id',
    	'name',
    	'module',
    	'permission',
    ];

    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
