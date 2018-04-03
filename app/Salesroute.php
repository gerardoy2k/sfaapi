<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesroute extends Model
{
    protected $fillable = [
    	'id',
    	'code',
    	'codeerp',
    	'description',
    	'type', /* P: Preventa A: Autoventa*/
    	'mobilepass',
        'orderprefix',
    	'salesoverinventory',
    	'allowchanges',
    	'allowdeposits',
    	'allowexportaccountsreceivable',
    	'allowexporthistory',
        'branch_id',
    	'status',
    ];

    public function isActive()
    {
    	return $this->status == Constants::ACTIVE;
    }
}
