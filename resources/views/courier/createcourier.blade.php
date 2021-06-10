@extends('main')

@section('isi')
<div class="panel panel-primary">
    <div class="panel panel-heading">
        <div class="panel-title text-center">
            <h2><label>ADD COURIER</label></h2>
        </div>
        <p class="panel-subtitle text-center">Form Menambahkan Data Kurir Produk</p>
    </div>
    <form action="{{ route('courier.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="panel panel-body">
            <div class="row">
                <h5 class="col-md-1"><label>Courier</label> </h5>
                <div class="col-md-11">
                    <input name="courier" type="text" class="form-control" placeholder="Courier Yang Ingin ditambahkan..."><span class="error text-danger"><p id="courier_error"></p></span>
                </div>
            </div>
        </div>
        <div class="panel panel-footer">
            <a href="{{ route('courier.index') }}" class="btn btn-info ">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            
            <button value="submit" type="submit" class="btn btn-outline-primary pull-right">
                <i class="fa fa-paper-plane"></i> Save
            </button>
        </div>
    </form>
</div>

@endsection
