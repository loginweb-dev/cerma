<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAccount extends Model
{
    protected $table ='detail_accounts';

    protected $fillable=['code','name','plan_of_account_id'];

    public function cuenta(){
        return $this->belongsTo(PlansOfAccount::class,'plan_of_account_id');
    }
}
