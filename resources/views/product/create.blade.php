@extends('main')

@section('isi')



<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h2><label>ADD Product</label></h2>
        </div>
        <p class="panel-subtitle text-center">Form Menambahkan Data Produk</p>
    </div>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel panel-body">
            <div class="panel-body">
                <div class="row">
                    <h5 class="col-md-1"><b>Product</b> </h5>
                    <div class="col-md-11">
                        <input name="product_name" type="text" class="form-control" placeholder="Product..."><span
                            class="error text-danger">
                            <p id="courier_error"></p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <h5 class="col-md-1"><label>Harga</label> </h5>
                    <div class="col-md-11">
                        <input name="price" type="text" class="form-control" placeholder="Harga..."><span
                            class="error text-danger">
                            <p id="courier_error"></p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <h5 class="col-md-1"><label>Berat</label> </h5>
                    <div class="col-md-11">
                        <input name="weight" type="text" class="form-control" placeholder="Berat..."><span
                            class="error text-danger">
                            <p id="courier_error"></p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <h5 class="col-md-1"><label>Stok</label> </h5>
                    <div class="col-md-11">
                        <input name="stock" type="text" class="form-control" placeholder="Stok..."><span
                            class="error text-danger">
                            <p id="courier_error"></p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <h5 class="col-md-1"><label>Description</label> </h5>
                    <div class="col-md-11">
                        <input name="description" type="text" class="form-control" placeholder="Deskripsi..."><span
                            class="error text-danger">
                            <p id="courier_error"></p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1">Category</label>
                    <div class="col-md-11">
                        <select multiple name="category_id[]" class="form-control select2" >                    
                            @foreach($categoryproduct as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->category_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1">Photo</label>
                    <div class="col-md-11">
                        <input multiple type="file" class="form-control " name="insert_photo[]">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a href="{{ route('product.index') }}" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

            <button value="submit" type="submit" class="btn btn-outline-primary">
                <i class="fa fa-paper-plane"></i> Save
            </button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: "-Pilih-"
    });
  });
</script>

@endsection
