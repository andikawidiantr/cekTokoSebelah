<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categorydetail extends Model
{
    use SoftDeletes;
    
    protected $table='product_category_details';

    protected $dates = ['deleted_at'];
}
