<?php

namespace App;

use App\Branch;
use App\Company;
use App\Country;
use App\Constants;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USER_VERIFIED = '1';
    const USER_NOT_VERIFIED = '0';

    const USER_ADMIN = 'true';
    const USER_NOT_ADMIN = 'false';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin',
        'country_id',
        'company_id',
        'branch_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token',
    ];

    public function isActive()
    {
        return $this->status == Constants::ACTIVE;
    }

    public function isVerified()
    {
        return $this->verified == User::USER_VERIFIED;
    }

    public function isAdmin()
    {
        return $this->admin == User::USER_ADMIN;
    }

    public static function createVerificationToken()
    {
        return str_random(40);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getProfile()
    {
        return ['country_id' => $this->country()->id,
                'company_id' => $this->company()->id,
                'branch_id' => $this->branch()->id,];
    }

}
