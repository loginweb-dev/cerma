<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Block extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'blocks';
    protected $fillable = ['name', 'title', 'description', 'page_id', 'position', 'details', 'type'];
}
