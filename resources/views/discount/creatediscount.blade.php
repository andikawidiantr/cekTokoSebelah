@extends('main')

@section('isi')
    
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if (session('sukses'))
            <div class="alert alert-danger" role="alert">
                {{ session('sukses') }}
            </div>
            @endif
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Diskon</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('discount.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Precentage</label>
                        <input type="number" class="form-control" name="percentage" id="exampleFormControlInput1" placeholder="Banyak Presentase">
                        @error('percentage')
                        <span class="text-danger mt-2">
                            Presentase diskon harus diisi dan unik
                        </span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Start Discount</label>
                        <input type="date" class="form-control" name="start" id="exampleFormControlInput1">
                        @error('start')
                        <span class="text-danger mt-2">
                            Tanggal mulai diskon harus diisi dan unik
                        </span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">End Discount</label>
                        <input type="date" class="form-control" name="end" id="exampleFormControlInput1">
                        @error('end')
                        <span class="text-danger mt-2">
                            Tanggal selesai diskon harus diisi dan unik
                        </span> 
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Daftar Barang</label>
                        <select class="form-control select2" name="id_product" id="id_product">
                            <option selected disabled>--Pilih--</option>
                            @foreach ($dataproduk as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Discount</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /.container-fluid -->

@endsection