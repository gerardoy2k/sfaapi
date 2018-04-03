<?php

namespace App;

use App\User;
use App\Branch;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
    	'id',
    	'name',
    ]; 

    public function companies()
    {
    	return $this->hasMany(Branch::class);
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
