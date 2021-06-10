<?php

namespace App\Http\Controllers;
use App\product;
use App\discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
            $data_diskon = discount::all();
            foreach ($data_diskon as $diskon){
                $hariini = Carbon::now()->setTimezone('GMT+8');
                $batas_waktu = $diskon->end;
         
                $tanggal_hariini = Carbon::parse($hariini);
                $end_date = Carbon::parse($batas_waktu);
                if($tanggal_hariini > $end_date){
                    $diskon = discount::find($diskon->id);
                    $diskon->delete();
                 }
            }
    
            return view ('discount.index',['data_diskon'=> $data_diskon]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataproduk = product::all();
        return view ('discount.creatediscount', compact('dataproduk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'percentage' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        
        // dd($request);
        $diskon = discount::create($request->all());
        // $diskon -> produk()->attach(request('id_product'));
        return redirect('/admin/discount')->with('sukses','Diskon baru berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(discount $discounts, $id){
        $data_produk = product::all();
        $data_diskon = discount::find($id);

        // dd($data_diskon->produk);

        return view('discount.editdiscount',['data_diskon'=> $data_diskon ], compact('data_produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $diskon = discount::find($id);
        $diskon ->update($request->all());
        return redirect('/admin/discount')->with('sukses','Data diskon telah diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(discount $discount)
    {
        $diskon = discount::find($id);
        $diskon->delete();
        return redirect ('/admin/discount')->with('sukses','Data diskon berhasil dihapus');
    }
}
