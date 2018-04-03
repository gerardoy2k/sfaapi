<?php

namespace App;

use App\User;
use App\Constants;
use App\Functionality;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'id',
    	'name',
        'description',
    	'status',
    ];

    public function isActive()
    {
    	return $this->status == Constants::ACTIVE;
    }

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function functionalities()
    {
    	return $this->belongsToMany(Functionality::class);
    }
}
