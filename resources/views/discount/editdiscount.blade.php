@extends('main')

@section('isi')

<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h2><label>EDIT Discount</label></h2>
        </div>
        <p class="panel-subtitle text-center">Form Mengubah Data Diskon Produk</p>
    </div>
    <form action="{{ route('discount.update',$data_diskon->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group">
            <label for="exampleFormControlInput1">Precentage</label>
            <input type="text" class="form-control" name="percentage" id="exampleFormControlInput1" placeholder="Banyak Presentase" value="{{ $data_diskon->percentage }}">
            @error('percentage')
            <span class="text-danger mt-2">
                Presentase diskon harus diisi dan unik
            </span> 
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Start Discount</label>
            <input type="date" class="form-control" name="start" id="exampleFormControlInput1" value="{{ $data_diskon->start }}">
            @error('start')
            <span class="text-danger mt-2">
                Tanggal mulai diskon harus diisi dan unik
            </span> 
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">End Discount</label>
            <input type="date" class="form-control" name="end" id="exampleFormControlInput1" value="{{ $data_diskon->end }}">
            @error('end')
            <span class="text-danger mt-2">
                Tanggal selesai diskon harus diisi dan unik
            </span> 
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Daftar Barang</label>
            <select class="form-control" name="id_product" id="id_product">
                @if (is_null($data_diskon->produk))
                    <option selected disabled>--Pilih--</option>
                @else
                    <option selected disabled value="{{ $data_diskon->produk->id }}">{{ $data_diskon->produk->product_name }}</option>
                @endif

                
                @foreach ($data_produk as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->product_name }}</option>
                        
                @endforeach
            </select>
            </div>
                    <button type="submit" class="btn btn-warning" >Edit Discount</button>
        </div>
    </form>
</div>


@endsection