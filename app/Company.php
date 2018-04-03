<?php

namespace App;

use App\Branch;
use App\Country;
use App\Constants;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
    	'id',
    	'name',
    	'rif',
    	'address',
    	'phone',
    	'country_id',
    	'status'
    ]; 

    public function isActive()
    {
    	return $this->status == Constants::ACTIVE;
    }

    public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    public function branches()
    {
    	return $this->hasMany(Branch::class);
    }
}
 