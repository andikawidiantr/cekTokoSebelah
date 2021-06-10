@extends('main')

@section('isi')
<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h2><label>EDIT CATEGORY</label></h2>
        </div>
        <p class="panel-subtitle text-center">Form Mengubah Data Kategori Produk</p>
    </div>
    <form action="{{ route('category.update',$data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-sm-1"><label>Category</label></h5>
                <div class="col-sm-11">
                    <input name="category_name" type="text" class="form-control" value="{{$data->category_name}}">
                </div>
            </div>
        </div>
        <div class="panel panel-footer">
            <a href="{{ route('category.index') }}" class="btn btn-info">
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
