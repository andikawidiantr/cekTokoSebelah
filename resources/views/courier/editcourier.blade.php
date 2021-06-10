@extends('main')

@section('isi')
<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h3 class="panel-tittle">Edit Courier</h3>
        </div>
        <p class="panel-subtitle text-center">Form Mengubah Data Kategori Produk</p>
    </div>
    <div class="panel-body">
        <form action="{{ route('courier.update',$data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="panel panel-body">
                <div class="row">
                    <h5 class="col-sm-1"><label>Courier</label></h5>
                    <div class="col-sm-11">
                        <input name="courier" type="text" class="form-control" value="{{$data->courier}}">
                    </div>
                </div>
            </div>
            <div class="panel panel-footer">
                <a href="{{ route('discount.index') }}" class="btn btn-info">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <span></span>
                <button value="submit" type="submit" class="btn btn-outline-primary pull-right">
                    <i class="fa fa-paper-plane"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>
        @endsection