<?php

namespace App\Http\Controllers;
use App\category;
use App\categorydetail;
use App\product;
use App\discount;
use App\productimage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data=product::with('RelasiCategory','RelasiImage','RelasiDiskon')->get();
        // $data = product::with('RelasiCategory')->get();
        return view('product.index',compact(['data'])); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryproduct = category::all();
        return view('product.create',compact(['categoryproduct']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new product;
        $data->product_name = $request->product_name;
        $data->price = $request->price;
        $data->stock = $request->stock;
        $data->weight = $request->weight;
        $data->description = $request->description;
        $data->save();
 
        $files = [];
        foreach($request->file('insert_photo') as $file){
            // $file = $request->file('insert_photo');
    
            $nama_file = time()."_".$file->getClientOriginalName();
            
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'product_image';
            $file->move($tujuan_upload,$nama_file);
                
            productimage::create([
                'image_name' => $nama_file,
                'product_id' => $data->id,
            ]);
        }
        
        //Menyimpan id product dan kategori product pada detail product
        $data -> RelasiCategory()->attach(request('category_id'));
        return redirect()->route('product.index')->with('success','Your data has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $data = product::where('id',$id)->with('RelasiCategory','RelasiImage')->first();
        // $data=$data[0];
        
        // dd($data);
        return view ('product.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data=product::where('id',$id)->first();
        $categoryproduct = category::all();
        $imageproduct = productimage::all();
        $daftar_category = $data->RelasiCategory;
        $daftar_gambar = $data->RelasiImage;
        return view ('product.edit',compact(['data','categoryproduct','daftar_category','daftar_gambar']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = product::find($id);
        // $category_baru = request('category_id');
        // $data ->update ($request->all());
        // $data -> RelasiCategory() ->sync($category_baru);
        //Memperbarui data
        // $dd($id);
        $data = product::find($id);
        $data->update([
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'weight'=>$request->weight,
            'description'=>$request->description
        ]);
        
        $data->RelasiCategory()->sync($request->category_id);
        
        // $category_baru = request ('category_id');
        
        $files = [];
        foreach($request->file('insert_photo') as $file){
            // $file = $request->file('insert_photo');
    
            $nama_file = time()."_".$file->getClientOriginalName();
            
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'product_image';
            $file->move($tujuan_upload,$nama_file);
                
            productimage::create([
                'image_name' => $nama_file,
                'product_id' => $data->id,
            ]);
        }

        return redirect()->route('product.index')->with('success','Your Data has Been Edited Successfully');
                        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    // hapus sementara
    public function hapus(Request $request,$id)
    {

        $data = product::find($id);

        $data->delete();
        
        return redirect()->route('product.index')->with('delete','Your Data Has Been Deleted Successfully');
    }

    // sampah
    public function trash()
    {
        // mengampil data guru yang sudah dihapus 
        $data = product::onlyTrashed()->get();
        //$data->RelasiCategory(product_id,$id)->get();
        // $productCategoryDetail = categorydetail::onlyTrashed()->get();
        return view('product.trash',compact(['data'=>$data]));
    }

    public function destroyfoto(productimage $productimage)
    {
        //dd($productimage->id);
        $productimage->delete();
        return redirect()->back();

        // $gambar = Gambar::where('id',$id)->first();
	    // File::delete('data_file/'.$gambar->file);

        // return redirect()->route('product.edit')->with('delete','Your Data Has Been Deleted Successfully');
    }

   /*  public function hapus_permanen(Request $request,$id)
    {
        $data =  product::onlyTrashed()->where('id',$id);
        $data ->forcedelete();

        return redirect('product.trash');
    } */
    
}
