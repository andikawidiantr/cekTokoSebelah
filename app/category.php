<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use SoftDeletes;
    
    protected $table='product_categories'; 

    public function RelasiCategory()
    {
        return $this->belongsToMany(category::class,'product_category_details','category_id','product_id');
    }

   	protected $dates = ['deleted_at'];
}
