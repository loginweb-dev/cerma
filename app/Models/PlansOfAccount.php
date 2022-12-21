<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlansOfAccount extends Model
{
    protected $table= 'plans_of_accounts';

    protected $fillable =['code','name', 'plan_of_account_id'];

    public function detailaccounts(){
       return $this->hasMany('App\Models\DetailAccount', 'plan_of_account_id','id');
    }
}
