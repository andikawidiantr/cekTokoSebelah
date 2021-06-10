<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\productimage;
use App\ProductReview;
use App\Response;
use App\Admin;
use App\User;
use App\category;
use App\categorydetail;
use App\UserNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=product::with('RelasiCategory','RelasiImage','RelasiDiskon')->get();
        $category = category::all();
        // dd($data);
         return view('user.index',compact(['data','category']));
    }

    public function kategorifilter($id)
    {
        // dd($product_categories);
        $data_kategori = category::all();
        $value = $id;
        $filterkategori = product::whereHas('RelasiCategory', function ($query) use ($value) {
            return $query->where($value, '=', 'category_id' );
        });

        // dd($filterkategori);
        return view('user.kategorifilter',['filterkategori' => $filterkategori, 'data_kategori' => $data_kategori]);
    }

    function detailproduct($id)
    {
        
        $product = product::find($id);
        $product_images = productimage::where('product_id','=',$product->id)->get();
        // $product_reviews = Product_Review::where('product_id', '=', $product->id)->with('user')->paginate(5);
        // $user = Auth::user();
        // $user_review = Product_Review::where('product_id', '=', $product->id)->where('user_id', '=', $user->id)->with('user')->first();
        // return view('user.detailproduct',compact('product', 'product_images', 'product_reviews','user','user_review'));
        return view('user.detailproduct',compact('product', 'product_images'));
    }

    public function tambahreview(Request $request){
        $products = $request->all();
        // dd($products);   
        $products ['user_id'] = Auth::user()->id;
        
        // dd($products);
        ProductReview::create($products);
        

        return redirect('/shop');

    }

    public function review_product($id, Request $request)
    {
        $request->validate([
            'rate' => ['required'],
            'content' => ['required', 'max:100']
        ]);

        $user = Auth::user();
        $review = new Product_Review();
        $review->product_id = $id;
        $review->user_id = $user->id;
        $review->rate = $request->rate;
        $review->content = $request->content;
        if($review->save()){
            $product = Product::find($id);
            $avg_rate = DB::select('SELECT AVG(rate) as avg_rate FROM product_reviews WHERE product_id=?', [$id]);
            $avg_rate = json_decode(json_encode($avg_rate), true);
            $product->product_rate = (int)round($avg_rate[0]["avg_rate"]);
            $product->save();

            $admin = Admin::find(2);
            $details = [
                'order' => 'Review',
                'body' => 'User has review our Product!',
                'link' => url(route('product.edit',['id'=> $id])),
            ];

            return redirect()->back()->with("Success", "Successfully Comment");
        }
        return redirect()->back()->with("error", "Failed Comment");
    }

    public function tampilnotifikasi(){
        $data_usernotofikassi = UserNotifications::where('notifiable_id', Auth::user()->id)->where('read_at', null)->orderBy('created_at','desc')->get();
        // $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        return view('user.user_notifikasi', compact('data_usernotofikassi'));
    }

    public function readNotifUser($id)
    {
        $notif = UserNotifications::find($id);
        $notif->read_at = NOW();
        $notif->save();
 
        return response()->json(['code' => 200]);
    }



}
