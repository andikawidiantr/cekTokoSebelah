<?php

namespace App\Http\Controllers;

use App\cart;
use App\product;
use App\productimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartproduk(){
        
        $data_cart= cart::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();
        $product= product::with('RelasiImage')->get();
        // dd($data_cart);

        return view('user.cart', compact('data_cart','product'));
    }

    public function store(Request $request){
        // dd($request);
        $cart = new cart();
        $cart->user_id=Auth::user()->id;
        $cart->product_id=$request->id_produk;
        $cart->qty=1;
        $cart->status='notyet';
        $cart->save();
        return redirect('/shop/cart');
    }

    public function hapuscart($id){
        $cart = cart::find($id);
        // dd($id);
        $cart->delete();
        return redirect('/shop/cart');
    }

    public function updateCart(){
        $qty=(int)request()->input('qty');
        $id=(int)request()->input('cart_id');
        $cart=Cart::find($id);
        $cart->update(["qty"=>$qty]);
    }

}
