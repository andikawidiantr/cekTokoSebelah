<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    protected $table = "discounts";
    protected $fillable = ['id_product','percentage','start','end'];

    public function produk(){
        return $this->belongsTo(product::class,'id_product','id');
    }
}
