<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Constants;

class Branch extends Model
{
    protected $fillable = [
    	'id',
    	'name',
    	'rif',
    	'address',
    	'phone',
    	'company_id',
    	'status'
    ]; 
    
    public function isActive()
    {
    	return $this->status == Constants::ACTIVE;
    }

    public function company()
    {
    	return $this->belongsTo(Company::class);
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }
    
}
