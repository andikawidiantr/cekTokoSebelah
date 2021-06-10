@extends('main')

@section('isi')
<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h2><label>EDIT PRODUCT</label></h2>
        </div>
        <p class="panel-subtitle text-center">Form Mengubah Data Produk</p>
    </div>
    <form action="{{ route('product.update',$data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-sm-1"><label>Product</label></h5>
                <div class="col-sm-11">
                    <input name="product_name" type="text" class="form-control" value="{{$data->product_name}}">
                </div>
            </div>
        </div>
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-sm-1"><label>Harga</label></h5>
                <div class="col-sm-11">
                    <input name="price" type="text" class="form-control" value="{{$data->price}}">
                </div>
            </div>
        </div>
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-sm-1"><label>Berat</label></h5>
                <div class="col-sm-11">
                    <input name="weight" type="text" class="form-control" value="{{$data->weight}}">
                </div>
            </div>
        </div>
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-sm-1"><label>Stock</label></h5>
                <div class="col-sm-11">
                    <input name="stock" type="text" class="form-control" value="{{$data->stock}}">
                </div>
            </div>
        </div>
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-sm-1"><label>Description</label></h5>
                <div class="col-sm-11">
                    <input name="description" type="text" class="form-control" value="{{$data->description}}">
                </div>
            </div>
        </div>
        <div class="panel panel-body">
                <div class="row">
                    <label class="col-md-1">Category</label>
                    <div class="col-md-11">
                        <select  multiple name="category_id[]" class="form-control select2" id="category_id">                    
                            @foreach ($daftar_category as $list_category)
                                <option selected value="{{ $list_category->id }}">{{ $list_category->category_name }}</option>  
                            @endforeach
                            
                            @foreach($categoryproduct as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->category_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="panel panel-body">
                <div class="row">
                    <label class="col-md-1">Photo</label>
                    <div class="col-md-11">                

                        @foreach ($daftar_gambar as $list_gambar)
                            <img width="100px" src="{{asset('product_image/'.$list_gambar->image_name)}}">
                        @endforeach
                        <br>
                        <input multiple type="file" class="form-control " name="insert_photo[]">
                                
                            
                            
                        </select>
                    </div>
                    
                </div>
            </div>
        <div class="panel panel-footer">
            <a href="{{ route('product.index') }}" class="btn btn-info">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <span></span>
            <button value="submit" type="submit" class="btn btn-outline-primary pull-right">
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
            placeholder: "{{ $kategori->category_name }} "
        });
    });
</script>
@endsection

