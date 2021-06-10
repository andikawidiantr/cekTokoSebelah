<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class courier extends Model
{   
    use SoftDeletes;
    protected $table='couriers';
    protected $dates = ['deleted_at'];
}
