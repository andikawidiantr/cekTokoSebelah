<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productimage extends Model
{
    protected $table='product_images';
    protected $fillable=['product_id','image_name'];

    //Relasi Many to Many dengan tabel product category
    public function RelasiImage()
    {
        return $this->hasMany(product::class,'product_id');
    }
}
