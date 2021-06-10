<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Province;
use App\City;
use App\courier;
use Illuminate\Support\Facades\Auth;

class BuyNowController extends Controller
{

    public function cartproduk(){
        $data_cart= cart::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        return view('user.buynow', compact('data_cart'));
    }

    public function storebuynow(Request $request){
        // dd($request);
        $cart = new Cart();
        $cart->user_id=Auth::user()->id;
        $cart->product_id=$request->id_produk;
        $cart->qty=1;
        $cart->status='notyet';
        $cart->save();

        $price=0;
        $total=0;
        $berat_total=0;
        $sub_price=0;

        $data_provinsi = Province::all();
        $data_kota = City::all();
        $data_kurir = courier::all();
        $data_cart= Cart::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        foreach ($data_cart as $cart){
            foreach ($cart->produk->RelasiDiskon as $diskon){
                if(date('Y-m-d')>= $diskon->start && date('Y-m-d')< $diskon->end){
                    $price = $cart->produk->price - ($diskon->percentage/100 * $cart->produk->price);
                    $total += $price * $cart->qty;
                }
            }
            if($price == 0){
                $total += $cart->produk->price * $cart->qty;
            }
            $berat_total = $berat_total + ($cart->produk->weight * $cart->qty);
           
        }
    

        return view('user.checkout',compact('data_cart','data_provinsi','data_kota','berat_total','data_kurir','total'));
    }

}
