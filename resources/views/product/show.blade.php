@extends('main')

@section('isi')

{{-- PESAN FEED BACK --}}
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fa fa-check-circle"> {{Session::get('success')}}</i>
</div>
@endif

@if(Session::has('delete'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fa fa-times-circle"> {{Session::get('delete') }}</i>
</div>
@endif

@if(Session::has('gagal'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fa fa-times-circle"> {{Session::get('gagal') }}</i>
</div>
@endif
<br>

{{-- ------------------------------------------DATA TABLE---------------------------------------- --}}
<div class="panel">
    <div class="panel panel-heading">
        <h2 class="text-left text-center"><b>Product</b> Detail</h2>
    </div>
    <div class="panel panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <!-- <th class="text-center">No</th> -->
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Berat</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Category</th>

                </tr>
            </thead>
            <tbody>
                
                <tr>
                    
                    <td class="text-center">{{$data->product_name}}</td>
                    <td class="text-center">Rp. {{number_format($data->price)}}</td>
                    <td class="text-center">{{$data->weight }} gram</td>
                    <td class="text-center">{{$data->stock }}</td>
                    <td class="text-center">{{$data->description }}</td>
                    <td class="text-center">
                        @foreach ($data->RelasiCategory as $productCategory)
                        {{$productCategory->category_name}}
                        @endforeach
                    </td>

                    <td class="text-center">{{$data->product_rate }}</td>
                </tr>
               
               
            </tbody>
        </table>
    </div>
</div>
<div class="panel">
    <div class="panel panel-heading">
        <h2 class="text-left text-center"><b>Product</b> Photo</h2>
    </div>
    <div class="panel panel-body">
        <div class="row text-center">
            @foreach ($data->RelasiImage as $productImage)
            <div style="display:inline-block; margin-right: 20px;">
                <img width="200px" src="{{asset('product_image/'.$productImage->image_name)}}">
                <form action="/admin/product/deletefoto/{{$productImage->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('DELETE')}}
                    <br>
                    {{-- TOMBOL DELETE --}}
                    <button name="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-xs">
                        DELETE
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div> 
<div class="panel">
    <div class="panel panel-heading">
        <h2 class="text-left text-center"><b>Review</b> Product</h2>
    </div>
    <div class="panel panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">Review</th>
                    <th class="text-center">Respone</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->reviewproduk as $no => $produk)
                <tr>
                    <td class="text-center">{{ $no+1 }}</td>

                    <td class="text-center">{{ $produk->user->name }}</td>   

                    <td class="text-center">{{ $produk->rate }}</td>
                    <td class="text-center">{{ $produk->content }}</td>
                    <td class="text-center">
                        @foreach ($produk->response as $response)
                            {{ $response->content}},
                        @endforeach

                    </td>
                    <td class="text-center">
                        <a href="/admin/response/{{ $produk->id }}" class="btn btn-primary btn-circle btn-sm">
                            <i class="fa fa-comments"></i>
                        </a>
                    </td>
                        
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

 <div class="panel">
    <div class="panel panel-footer">
        <a href="{{ route('product.index') }}" class="btn btn-info">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>
    </div>
<link rel="stylesheet" href="{{asset('style/assets/css/buatan.css')}}">

@endsection