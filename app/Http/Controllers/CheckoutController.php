<?php
namespace App\Http\Controllers;
use App\Admin;
use App\AdminNotifications;
use App\Cart;
use App\Transactions;
use App\TransactionsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;
use App\Province;
use App\courier;
use App\product;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Carbon\Carbon;
use App\User;

// use App\Transactions;
// use App\TransactionsDetail;


class CheckoutController extends Controller
{
    public function checkoutproduk(){
        $price=0;
        $total=0;
        $berat_total=0;
        $sub_price=0;

        $data_cart= Cart::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();
        $data_provinsi = Province::all();
        $data_kota = City::all();
        $data_kurir = courier::all();

        // dd($data_cart);


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

        return view('user.checkout', compact('data_cart','data_provinsi','data_kota','berat_total','data_kurir', 'total'));
    }

    public function cekongkir(Request $request){
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 114, // ID kota/kabupaten asal
            'destination'   => $request->kota, // ID kota/kabupaten tujuan
            'weight'        => $request->berat, // berat barang dalam gram
            'courier'       => $request->kurir // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }

    public function store(Request $request){
        $price=0;
        $total=0;

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
        }
        $transaksi = new Transactions;
        $date_time = strtotime('+1 day');
        $tanggal_besok = date('Y-m-d H:i:s',$date_time);
        $transactions = $request->all();
        $transactions['timeout'] = $tanggal_besok;

        // return ($tanggal_besok);

        $transactions['total'] = $request->shipping_cost + $total;
        $transactions['sub_total'] = $total;
        $transactions['user_id'] = Auth::user()->id;
        $transactions['status'] = 'unverified';
        $id_transaksi = $transaksi->create($transactions);


        foreach($data_cart as $key=>$value){
            TransactionsDetail::create([
                'transaction_id' => $id_transaksi->id,
                'product_id' => $value->product_id,
                'qty' => $value->qty,
                'discount' => $request->discount,
                'selling_price'=> $request->selling_price
            ]);
            
            Cart::where('user_id', Auth::user()->id)->update([
                'status' => 'checkedout',
            ]);

            // --Buat saat barang di checkout maka stock barang akan di kurangi dengan qty--
            // Products::where('product_id' == $value->product_id )->update([
            //     'stock' => $value->stock - $value->qty,
            // ]);

        }

        $admin = Admin::find(2);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Telah melakukan transaksi',
            'id'=>$id_transaksi->id
        ];

        $data_encode = json_encode($data);

        $admin->createNotifAdmin($data_encode);


        $user = User::find($id_transaksi->user_id);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Transaksi anda sedang diproses',
            'id'=>$id_transaksi->id
        ];
        $data_encode = json_encode($data);

        $user->createNotifUser($data_encode);

        // Products::where('user_id', Auth::user()->id)->update([
        //     'stock' => 'checkedout',
        // ]);

        // dd($id_transaksi->id);
        return redirect('/shop/uploadbukti/'.$id_transaksi->id);
    }

    public function konfirmasiproduk($id){
        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);

        // $data_transaksi = Transactions::find($id);
        $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        $hariini = Carbon::now()->setTimezone('GMT+8');

        $date = Carbon::parse($today);
        $tanggal_hariini = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $tanggal = $data_transaksi->timeout;

        $batas_waktu = $data_transaksi->timeout;

        // dd($tanggal);
        $selisih_waktu = Carbon::parse($tanggal)->diff($today,false);
        $sec = $selisih_waktu->s;
        $menit = $selisih_waktu->i;
        $jam = $selisih_waktu->h;
        $deadline = $jam.':'.$menit.':'.$sec;

        // $tanggal_parse = Carbon::parse($tanggal_hariini);
        // $tanggal_hariini_menit = Carbon::parse($tanggal_hariini);

        $tanggal_hariini = Carbon::parse($hariini);
        $end_date = Carbon::parse($batas_waktu);

        // $waktu_sekarang = $tanggal_hariini.$today;
        // $hasildiff = Carbon::parse($tanggal)->diff($today,false);
        // return( $menit);
        // return($tanggal);
        // dd($data_transaksi->produk);

        if($data_transaksi->status == 'unverified'){

            if($tanggal_hariini >= $end_date){
                $data_transaksi->status = 'expired';
                $data_transaksi->save();
                // return ('Gagal Bayar');
                $user = User::find($data_transaksi->user_id);
                $data = [
                    'nama'=>Auth::user()->name,
                    'massage'=>'Transaksi anda telah kadarluarsa',
                    'id'=>$data_transaksi->id
                ];
        
                // dd($data);
        
                $data_encode = json_encode($data);
        
                $user->createNotifUser($data_encode);
            }
        }


        // else {
        //     return ('Yuuk Bayar');
        // }

        // return($data_transaksi);
        
        return view('user.uploadbukti', compact('deadline','data_transaksi'));
    }

    public function addreview($id){
        $product= product::find($id);
    
        // dd($id);
        return view('user.addreview', compact('product'));
    }

    public function cancelproduk($id){
        $data_transaksi = Transactions::find($id);
        // $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        // $date = Carbon::parse($today);
        $data_transaksi->status = 'canceled';
        $data_transaksi->save();

        $user = User::find($data_transaksi->user_id);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'pembatalan transaksi anda berhasil',
            'id'=>$data_transaksi->id
        ];
        
        // dd($user);
        $data_encode = json_encode($data);

        $user->createNotifUser($data_encode);

        $admin = Admin::find(2);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Telah membatalkan pesanan',
            'id'=>$data_transaksi->id
        ];

        $data_encode = json_encode($data);

        $admin->createNotifAdmin($data_encode);

        return redirect('/shop');
    }

    public function uploadpembayaran($id, Request $request){

        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);
        foreach($request->file('foto_pembayaran') as $file){
            // dd($data_transaksi->produk->pluck('id'));

            $nama_image = md5(now().'_').$file->getClientOriginalName();
            //
            $tujuan_upload = 'bukti_bayar';
            $file->move($tujuan_upload,$nama_image);

            $data_transaksi = Transactions::find($id);
            $data_transaksi->proof_of_payment = $nama_image;
            // $data_transaksi->status = 'verified';
            $data_transaksi->save();
        }
        return redirect('/shop/sukses-bayar/'.$data_transaksi->id);
    }

    public function suksesbayar($id){
        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);

        // $data_transaksi = Transactions::find($id);
        // $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        $tambahlimamenit = $data_transaksi->updated_at->addMinutes(5)->toTimeString();
        // $newDateTime = Carbon::now()->setTimezone('GMT+8')->addMinutes(25)->toTimeString();
        $hariini = Carbon::now()->setTimezone('GMT+8');
        
        $tanggal_hariini = Carbon::parse($hariini);
        $waktu_kirim = Carbon::parse($tambahlimamenit);
        // dd($waktu_kirim);

        if($data_transaksi->status == 'verified'){
            if($tanggal_hariini >= $waktu_kirim){
                $data_transaksi->status = 'delivered';
                $data_transaksi->save();
                // return ('Barang terkirim');
                $user = User::find($data_transaksi->user_id);
                $data = [
                    'nama'=>Auth::user()->name,
                    'massage'=>'Barang pesanan sedang dalam perjalanan',
                    'id'=>$data_transaksi->id
                ];   
                // dd($user);
                $data_encode = json_encode($data);
        
                $user->createNotifUser($data_encode);
            }
        }
        return view('user.statuspesanan', compact('data_transaksi'));
    }

    public function tampiltransaksi(){
        $data_transaksi = Transactions::where('user_id', Auth::user()->id)->get();
        // $data_user = User::find($id);


        return view('user.viewtransaksi', compact('data_transaksi'));
    }
}
