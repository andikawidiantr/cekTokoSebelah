<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\productimage;

class product extends Model
{
    use SoftDeletes;

    protected $table='products';
    protected $fillable=['id','product_name','price','stock','weight','description'];

    //Relasi Many to Many dengan tabel product category
    public function RelasiCategory()
    {
        return $this->belongsToMany(category::class,'product_category_details','product_id','category_id');
    }
    public function RelasiImage()
    {   
        return $this->hasMany(productimage::class);
    }
    public function RelasiDiskon(){
        return $this->hasMany(discount::class, 'id_product','id');
    }
    
    public function getfirstimage(){
        $image = productimage::where('product_id', $this->id)->first();
        return $image;
    }

    protected $dates = ['deleted_at'];

    public function reviewproduk(){
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
