<?php

namespace App\Http\Controllers;

use App\AdminNotifications;
use Illuminate\Http\Request;
use App\Transactions;
use Carbon\Carbon;
use App\product;
use App\User;
use App\Admin;
use App\ProductReview;
use App\Response;
use Illuminate\Support\Facades\Auth;
use App\TransactionsDetail;

class AdminDashboardController extends Controller
{
    public function index(){
       $data_transaksi = Transactions::orderBy('created_at','desc')->get();
       $hariini = Carbon::now()->setTimezone('GMT+8');
       
       foreach ($data_transaksi as $transaksi){
           $batas_waktu = $transaksi->timeout;
           
           $tanggal_hariini = Carbon::parse($hariini);
           $end_date = Carbon::parse($batas_waktu);
           if($transaksi->status == 'unverified'){
               if($tanggal_hariini >= $end_date){
                   $transaksi->status = 'expired';
                   $transaksi->save();
                }
            }
        }
        
        //    dd($newDateTime);
        foreach ($data_transaksi as $transaksi){
            $id_pelanggan= User::find($transaksi->user_id);
            $tambahlimamenit = $transaksi->updated_at->addMinutes(5)->toTimeString();

            $tanggal_hariini = Carbon::parse($hariini);
            $waktu_kirim = Carbon::parse($tambahlimamenit);

            if($transaksi->status == 'verified'){
                if($tanggal_hariini >= $waktu_kirim){
                    $transaksi->status = 'delivered';
                    $transaksi->save();
                    // return ('Barang terkirim');

                    $user = User::find($transaksi->user_id);
                    $data = [
                        'nama'=>$id_pelanggan->name,
                        'massage'=>'Barang pesanan sedang dalam perjalanan',
                        'id'=>$transaksi->id
                    ];
                    
                    // dd($user);
                    $data_encode = json_encode($data);
            
                    $user->createNotifUser($data_encode);
                }
            }
        }
       
       return view('admin.admin_transaksi', compact('data_transaksi'));
    }

    public function viewdetail($id){
       $data_transaksi = Transactions::find($id);
    //    return ($data_transaksi->proof_of_payment);

       return view('admin.admin_transaksi_view', compact('data_transaksi'));
    }

    public function readNotif($id)
    {
       $notif = AdminNotifications::find($id);
       $notif->read_at = NOW();
       $notif->save();

       return response()->json(['code' => 200]);
    }

    public function updatestatus(Request $request, $id){
        $data_transaksi = Transactions::find($id);
        $id_pelanggan= User::find($data_transaksi->user_id);
        // dd($request->pilih_status);
        // $data_transaksi ->update($request->all());

        $data_transaksi->status = $request->pilih_status;
        $data_transaksi->save();

        $user = User::find($data_transaksi->user_id);
        $data = [
            'nama'=>$id_pelanggan->name,
            'massage'=>'produk telah diterima dengan selamat',
            'id'=>$data_transaksi->id
        ];
        
        // dd($user);
        $data_encode = json_encode($data);

        $user->createNotifUser($data_encode);

        return redirect('/admin/transaksi');
    }

    public function verifikasipembayaran ($id, Request $request){
        $data_transaksi= Transactions::find($id);
        $id_pelanggan= User::find($data_transaksi->user_id);
        // dd($id_pelanggan->name);

        $data_transaksi = Transactions::find($id);
        $data_transaksi->status = $request->pilih_status;
        $data_transaksi->save();

        if($request->pilih_status == 'canceled'){
    
            $user = User::find($data_transaksi->user_id);
            $data = [
                'nama'=>$id_pelanggan->name,
                'massage'=>'transaksi anda telah dibatalkan karena tidak sesuai ketentuan',
                'id'=>$data_transaksi->id
            ];
            
            // dd($user);
            $data_encode = json_encode($data);
    
            $user->createNotifUser($data_encode);
        }

        if($request->pilih_status == 'verified'){
            foreach($data_transaksi->detail_transaksi as $transaksi){
                // --Buat saat barang di checkout maka stock barang akan di kurangi dengan qty--
                $stock_barang = $data_transaksi->produk[0]->stock;
                $jumlah_beli = $data_transaksi->detail_transaksi[0]->qty;
                // $w = $stock_barang - $jumlah_beli;
    
                // dd($w);
    
                product::where('id', $transaksi->product_id )->update([
                    'stock' => $stock_barang - $jumlah_beli
                ]);
            }
    
            $user = User::find($data_transaksi->user_id);
            $data = [
                'nama'=>$id_pelanggan->name,
                'massage'=>'pembayaran anda telah terverifikasi',
                'id'=>$data_transaksi->id
            ];
            
            // dd($user);
            $data_encode = json_encode($data);
    
            $user->createNotifUser($data_encode);
        }


        return redirect('/admin/transaksi');
    }

    public function view_allnotif (){
        // dd(Auth::user()->id);
        $data_adminnotofikassi = AdminNotifications::where('read_at', null)->orderBy('created_at','desc')->get();
       
        // $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();
    
        // return view('/user_layouts/user_notifikasi', compact('data_usernotofikassi'));
       
        return view('admin.admin_notifikasi',  compact('data_adminnotofikassi'));

    }

    public function uploadfotoadmin ($id, Request $request){
        $data_admin = Admin::find($id);
        // dd($request->file('admin_foto'));

        foreach($request->file('admin_foto') as $foto){
            // dd($data_transaksi->produk->pluck('id'));

            $nama_image = md5(now().'_').$foto->getClientOriginalName();
            $foto->storeAs('img/fotoprofileadmin',$nama_image);

            $data_admin = Admin::find($id);
            $data_admin->profile_image = $nama_image;
            // $data_transaksi->status = 'verified';
            $data_admin->save();

        }

        return redirect('/admin/profile');
    }


    public function edit_foto (){
        return view('admin_layouts.admin_edit_profile');

    }
   
    public function viewprofile (){
       return view('admin_layouts.admin_profile');

    }
    
    public function admin_response($id){
        $data_review = ProductReview::find($id);
        return view('admin.admin_response', compact('id','data_review'));
    }

    public function upload_response ($id, Request $request){
    //   dd(Auth::user());
       $data_review = ProductReview::find($id);
        
        $response = $request->all();
        $response ['admin_id'] =  Auth::guard('admin')->user()->id ;
        $response ['review_id'] = $id;
        // dd($response);
        Response::create($response);

        return redirect('admin/product/'.$data_review->product_id)->with('sukses','Pesan respon berhasil dikirim');

    }

    public function getDataPenjualan(){
        $index = 1;
        $jan = 0;
        $feb = 0;
        $mar = 0;
        $apr = 0;
        $mei = 0;
        $jun = 0;
        $jul = 0;
        $augs = 0;
        $sep = 0;
        $okt = 0;
        $nov = 0;
        $des = 0;

        $tahun1 = 0;
        $tahun2 = 0;
        $tahun3 = 0;
        $tahun4 = 0;
        $tahun5= 0;

        $tahun = date('Y');

        // dd($tahun);

        for($i = $tahun; $i >= $tahun-5; $i--)
        {
            $data_penjualan = Transactions::whereYear('created_at', $i)->get();

            foreach($data_penjualan as $dp){
                if($i == $tahun){
                    
                    $tahun1 = $tahun1 + $dp->total;
                }
                if($i == $tahun-1){
                    
                    $tahun2 = $tahun2 + $dp->total;
                }
                if($i == $tahun-2){
                    
                    $tahun3 = $tahun3 + $dp->total;
                }
                if($i == $tahun-3){
                    
                    $tahun4 = $tahun4 + $dp->total;
                }
                if($i == $tahun-4){
                    
                    $tahun5 = $tahun5 + $dp->total;
                }
                
                // dd($i);
            }
            
        }

        for($index; $index <= 12; $index++)
        {
            $data_penjualan = Transactions::whereMonth('created_at', $index)->get();

            foreach($data_penjualan as $dp){
                if($index == 1){
                    $jan = $jan + $dp->total;
                }
                if($index == 2){
                    $feb = $feb + $dp->total;
                }
                if($index == 3){
                    $mar = $mar + $dp->total;
                }
                if($index == 4){
                    $apr = $apr + $dp->total;
                }
                if($index == 5){
                    $mei = $mei + $dp->total;
                }
                if($index == 6){
                    $jun = $jun + $dp->total;
                }
                if($index == 7){
                    $jul = $jul + $dp->total;
                }
                if($index == 8){
                    $augs = $augs + $dp->total;
                }
                if($index == 9){
                    $sep = $sep + $dp->total;
                }
                if($index == 10){
                    $okt = $okt + $dp->total;
                }
                if($index == 11){
                    $nov = $nov + $dp->total;
                }
                if($index == 12){
                    $des = $des + $dp->total;
                }

            }
        }
        // dd($jun);
        $data_sukses_tahun=[];
        $data_cancel_tahun=[];
        $data_proses_tahun=[];        
        $trans_cancel = Transactions::where('status', 'canceled')->orWhere('status', 'expired')->get();
        $trans_proses = Transactions::where('status', 'unverified')->orWhere('status', 'verified')->orWhere('status', 'delivered')->get();
        $trans_sukses = Transactions::where('status', 'success')->get();
        for ($i = 1; $i <= 12; $i++) {
            $j = 0;
            foreach ($trans_sukses as $t) {
                $month_number = (int)date("n", strtotime($t->created_at->format('M')));
                if ($month_number == $i) {
                    $j++;
                }
            }
            array_push($data_sukses_tahun, $j);
        }
        for ($i = 1; $i <= 12; $i++) {
            $j = 0;
            foreach ($trans_cancel as $t) {
                $month_number = (int)date("n", strtotime($t->created_at->format('M')));
                if ($month_number == $i) {
                    $j++;
                }
            }
            array_push($data_cancel_tahun, $j);
        }
        for ($i = 1; $i <= 12; $i++) {
            $j = 0;
            foreach ($trans_proses as $t) {
                $month_number = (int)date("n", strtotime($t->created_at->format('M')));
                if ($month_number == $i) {
                    $j++;
                }
            }
            array_push($data_proses_tahun, $j);
        }
        return view('admin.admindashboard', compact('jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'augs', 'sep', 'okt', 'nov', 'des','tahun1', 'tahun2', 'tahun3', 'tahun4', 'tahun5', 'tahun','data_sukses_tahun','data_cancel_tahun','data_proses_tahun'));
    }

}
