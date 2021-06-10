<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    protected $fillable=['user_id','product_id','qty'];
    public function produk(){
        return $this->belongsTo(product::class, 'product_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
